<?php
namespace DocuWare;

class Section
{
    use Traits\Common;

    /**
     * Get all sections
     * @param  string $fileCabinetId File Cabinet ID
     * @param  string $docId Document ID
     * @return string
     * @throws \Exception
     */
    public function getAll($fileCabinetId, $docId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Sections?docid={$docId}";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $this->formatResult($result);
    }

    /**
     * Show data of section
     * @param  string $fileCabinetId File Cabinet ID
     * @param  string $sectionId Section ID
     * @return string
     * @throws \Exception
     */
    public function show($fileCabinetId, $sectionId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Sections/{$sectionId}";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $this->formatResult($result);
    }

    /**
     * Deletes given section
     * @param  string $fileCabinetId File Cabinet ID
     * @param  string $sectionId Section ID
     * @return string
     * @throws \Exception
     */
    public function delete($fileCabinetId, $sectionId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Sections/{$sectionId}";

        $result = $this->platform->deleteResource($this->platform->buildURL($path));
        return $result;
    }
}
