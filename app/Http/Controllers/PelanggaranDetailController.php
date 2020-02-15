<?php

namespace App\Http\Controllers;

use App\DataTables\PelanggaranDetailDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePelanggaranDetailRequest;
use App\Http\Requests\UpdatePelanggaranDetailRequest;
use App\Repositories\PelanggaranDetailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Pelanggaran;

class PelanggaranDetailController extends AppBaseController
{
    /** @var  PelanggaranDetailRepository */
    private $pelanggaranDetailRepository;
    private $pelanggaranRepository;

    public function __construct(PelanggaranDetailRepository $pelanggaranDetailRepo)
    {
        $this->pelanggaranDetailRepository = $pelanggaranDetailRepo;
    }

    /**
     * Display a listing of the PelanggaranDetail.
     *
     * @param PelanggaranDetailDataTable $pelanggaranDetailDataTable
     * @return Response
     */
    public function index(PelanggaranDetailDataTable $pelanggaranDetailDataTable)
    {
        return $pelanggaranDetailDataTable->render('pelanggaran_details.index');
    }

    /**
     * Show the form for creating a new PelanggaranDetail.
     *
     * @return Response
     */
    public function create()
    {
        $pelanggaranMaster = Pelanggaran::all();
        return view('pelanggaran_details.create')->with('pelanggaranMaster', $pelanggaranMaster);
    }

    /**
     * Store a newly created PelanggaranDetail in storage.
     *
     * @param CreatePelanggaranDetailRequest $request
     *
     * @return Response
     */
    public function store(CreatePelanggaranDetailRequest $request)
    {
        $input = $request->all();

        $pelanggaranDetail = $this->pelanggaranDetailRepository->create($input);

        Flash::success('Pelanggaran Detail saved successfully.');

        return redirect(route('pelanggaranDetails.index'));
    }

    /**
     * Display the specified PelanggaranDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pelanggaranDetail = $this->pelanggaranDetailRepository->with(['bio_siswa', 'pelanggaran', 'tindakan'])->find($id);

        if (empty($pelanggaranDetail)) {
            Flash::error('Pelanggaran Detail not found');

            return redirect(route('pelanggaranDetails.index'));
        }

        return view('pelanggaran_details.show')->with('pelanggaranDetail', $pelanggaranDetail);
    }

    /**
     * Show the form for editing the specified PelanggaranDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pelanggaranDetail = $this->pelanggaranDetailRepository->find($id);
        $pelanggaranMaster = Pelanggaran::all();

        if (empty($pelanggaranDetail)) {
            Flash::error('Pelanggaran Detail not found');

            return redirect(route('pelanggaranDetails.index'));
        }

        return view('pelanggaran_details.edit', ['pelanggaranDetail' => $pelanggaranDetail, 'pelanggaranMaster' => $pelanggaranMaster ]);
    }

    /**
     * Update the specified PelanggaranDetail in storage.
     *
     * @param  int              $id
     * @param UpdatePelanggaranDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePelanggaranDetailRequest $request)
    {
        $pelanggaranDetail = $this->pelanggaranDetailRepository->find($id);

        if (empty($pelanggaranDetail)) {
            Flash::error('Pelanggaran Detail not found');

            return redirect(route('pelanggaranDetails.index'));
        }

        $pelanggaranDetail = $this->pelanggaranDetailRepository->update($request->all(), $id);

        Flash::success('Pelanggaran Detail updated successfully.');

        return redirect(route('pelanggaranDetails.index'));
    }

    /**
     * Remove the specified PelanggaranDetail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pelanggaranDetail = $this->pelanggaranDetailRepository->find($id);

        if (empty($pelanggaranDetail)) {
            Flash::error('Pelanggaran Detail not found');

            return redirect(route('pelanggaranDetails.index'));
        }

        $this->pelanggaranDetailRepository->delete($id);

        Flash::success('Pelanggaran Detail deleted successfully.');

        return redirect(route('pelanggaranDetails.index'));
    }
}
