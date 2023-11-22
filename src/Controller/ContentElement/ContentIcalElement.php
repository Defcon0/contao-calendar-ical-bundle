<?php

declare(strict_types=1);

/*
 * This file is part of cgoit\contao-calendar-ical-php8-bundle for Contao Open Source CMS.
 *
 * @copyright  Copyright (c) 2023, cgoIT
 * @author     cgoIT <https://cgo-it.de>
 * @license    LGPL-3.0-or-later
 */

namespace Cgoit\ContaoCalendarIcalBundle\Controller\ContentElement;

use Cgoit\ContaoCalendarIcalBundle\Export\IcsExport;
use Contao\CalendarModel;
use Contao\ContentModel;
use Contao\Controller;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Exception\ResponseException;
use Contao\File;
use Contao\FrontendTemplate;
use Contao\Input;
use Contao\StringUtil;
use Contao\System;
use Contao\Template;
use Kigkonsult\Icalcreator\Vcalendar;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

#[AsContentElement(type: ContentIcalElement::TYPE, category: 'files')]
class ContentIcalElement extends AbstractContentElementController
{
    final public const TYPE = 'ical';

    protected string $strTitle = '';

    protected Vcalendar $ical;

    public function __construct(
        private readonly string $projectDir,
        private readonly IcsExport $icsExport,
    ) {
    }

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        System::loadLanguageFile('tl_content');
        $ical = $this->getIcalFile($model);

        if (!empty($ical)) {
            if (!empty(Input::get('ical'))) {
                $filename = StringUtil::sanitizeFileName($model->ical_title).'.ics';
                $file = new File('system/tmp/'.$filename);
                $file->write($ical->createCalendar());
                $file->close();
                $binaryFileResponse = new BinaryFileResponse(new SymfonyFile($this->projectDir.'/'.$file->path));
                $binaryFileResponse->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);

                throw new ResponseException($binaryFileResponse);
            }

            // Generate a general HTML output using the download template
            $tpl = new FrontendTemplate(empty($model->ical_download_template) ? 'ce_download' : $model->ical_download_template);
            $tpl->link = !empty($model->linkTitle) ? $model->linkTitle : $GLOBALS['TL_LANG']['tl_content']['ical_download_title'];
            $tpl->title = $GLOBALS['TL_LANG']['tl_content']['ical_download_title'];
            $tpl->href = Controller::addToUrl('ical=1');
            $tpl->filesize = System::getReadableSize(\strlen($ical->createCalendar()));
            $tpl->mime = 'text/calendar';
            $tpl->extension = 'ics';
            $template->downloadElement = $tpl->parse();

            return $template->getResponse();
        }

        $template->error = $GLOBALS['TL_LANG']['tl_content']['error_generating_ical_file'];

        return $template->getResponse();
    }

    private function getIcalFile(ContentModel $model): Vcalendar|null
    {
        $startDate = !empty($model->ical_start) ? (int) $model->ical_start : time();
        $endDate = !empty($model->ical_end) ? (int) $model->ical_end : time() + 365 * 24 * 3600;

        $arrCalendars = CalendarModel::findMultipleByIds(StringUtil::deserialize($model->ical_calendar, true));
        if (!empty($arrCalendars)) {
            return $this->icsExport->getVcalendar($arrCalendars, $startDate, $endDate, $model->ical_title, $model->ical_description, $model->ical_prefix);
        }

        return null;
    }
}
