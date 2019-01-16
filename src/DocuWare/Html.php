<?php
namespace DocuWare;

/**
 * HTML rendering class
 * Not sure what the point of this is
 */
class Html
{
    use Traits\Common;

    /**
     * Shows dialogs in Html view
     * @param  string $fileCabinetId File Cabinet ID
     * @return html
     * @throws \Exception
     */
    public function dialogs($fileCabinetId)
    {
        $path = '/FileCabinets/'.$fileCabinetId.'/html/Dialogs';

        $pathOptions = ['orgId' => ['required' => true]];
        $pathParameters = ['orgId' => $this->platform->organizationId];
        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        return $result;
    }

    /**
     * Shows document in Html viewer
     * @param  string $fileCabinetId File Cabinet ID
     * @param  int $docId Document ID
     * @param  int $sectionId Section ID
     * @return html
     * @throws \Exception
     */
    public function viewDocument($fileCabinetId, $docId, $sectionId = null)
    {
        $path = '/FileCabinets/'.$fileCabinetId.'/html/View';

        if (!is_null($sectionId)) {
            $pathOptions = ['docId' => ['required' => true], 'sectionId' => ['required' => true]];
            $pathParameters = ['docId' => $docId, 'sectionId' => $sectionId];
        } else {
            $pathOptions = ['docId' => ['required' => true]];
            $pathParameters = ['docId' => $docId];
        }

        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        return $result;
    }
}
