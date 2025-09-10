<?php

namespace App\Repositories;

use App\Interfaces\ReportStatusRepositoryInterface;
use App\Models\ReportStatus;

class ReportStatusRepository implements ReportStatusRepositoryInterface
{
  public function getAllReportStatuses()
  {
    return ReportStatus::all();
  }

  public function getReportStatusById(int $id)
  {
    return ReportStatus::findOrFail($id);
  }

  public function createReportStatus(array $data)
  {
    return ReportStatus::create($data);
  }

  public function updateReportStatus(array $data, int $id)
  {
    $reportStatus = $this->getReportStatusById($id);
    return $reportStatus->update($data);
  }

  public function deleteReportStatus(int $id)
  {
    $reportStatus = $this->getReportStatusById($id);
    return $reportStatus->delete();
  }
}
