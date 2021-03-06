<?php

namespace App\Http\Controllers;

use App\DataTables\PembayaranDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\Pembayaran;
use App\Repositories\BioSiswaRepository;
use App\Repositories\JenisBayarRepository;
use App\Repositories\JenisProdukBayarRepository;
use App\Repositories\PembayaranRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Response;

class PembayaranController extends AppBaseController
{
    /** @var  PembayaranRepository */
    private $pembayaranRepository;
    private $bioSiswaRepository;
    private $jenisBayarRepository;
    private $jenisProdukBayarRepository;

    public function __construct(PembayaranRepository $pembayaranRepo, BioSiswaRepository $bioSiswaRepository, JenisBayarRepository $jenisBayarRepository, JenisProdukBayarRepository $jenisProdukBayarRepository)
    {
        $this->pembayaranRepository = $pembayaranRepo;
        $this->bioSiswaRepository = $bioSiswaRepository;
        $this->jenisBayarRepository = $jenisBayarRepository;
        $this->jenisProdukBayarRepository = $jenisProdukBayarRepository;
    }

    /**
     * Display a listing of the Pembayaran.
     *
     * @param PembayaranDataTable $pembayaranDataTable
     * @return Response
     */
    public function index(PembayaranDataTable $pembayaranDataTable)
    {
        return $pembayaranDataTable->render('pembayarans.index');
    }

    /**
     * Show the form for creating a new Pembayaran.
     *
     * @return Response
     */
    public function create()
    {
        $bio_siswa = $this->bioSiswaRepository->pluck('nama_lengkap', 'no_induk');
        $jenis_bayar = $this->jenisBayarRepository->pluck('jenis_bayar', 'id_jenis');
        $jenis_produk_bayar = $this->jenisProdukBayarRepository->pluck('jenis_produk', 'id_jenis_produk');
        return view('pembayarans.create', compact(['bio_siswa', 'jenis_bayar', 'jenis_produk_bayar']));
    }

    /**
     * Store a newly created Pembayaran in storage.
     *
     * @param CreatePembayaranRequest $request
     *
     * @return Response
     */
    public function store(CreatePembayaranRequest $request)
    {
        $input = $request->all();

        $pembayaran = $this->pembayaranRepository->create($input);

        Flash::success('Pembayaran saved successfully.');

        return redirect(route('pembayarans.index'));
    }

    /**
     * Display the specified Pembayaran.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pembayaran = $this->pembayaranRepository->find($id);

        if (empty($pembayaran)) {
            Flash::error('Pembayaran not found');

            return redirect(route('pembayarans.index'));
        }

        return view('pembayarans.show')->with('pembayaran', $pembayaran);
    }

    /**
     * Show the form for editing the specified Pembayaran.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pembayaran = $this->pembayaranRepository->find($id);
        $bio_siswa = $this->bioSiswaRepository->pluck('nama_lengkap', 'no_induk');
        $jenis_bayar = $this->jenisBayarRepository->pluck('jenis_bayar', 'id_jenis');
        $jenis_produk_bayar = $this->jenisProdukBayarRepository->pluck('jenis_produk', 'id_jenis_produk');

        if (empty($pembayaran)) {
            Flash::error('Pembayaran not found');

            return redirect(route('pembayarans.index'));
        }

        return view('pembayarans.edit', compact(['pembayaran','bio_siswa', 'jenis_bayar', 'jenis_produk_bayar']));
    }

    /**
     * Update the specified Pembayaran in storage.
     *
     * @param  int              $id
     * @param UpdatePembayaranRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePembayaranRequest $request)
    {
        $pembayaran = $this->pembayaranRepository->find($id);

        if (empty($pembayaran)) {
            Flash::error('Pembayaran not found');

            return redirect(route('pembayarans.index'));
        }

        $pembayaran = $this->pembayaranRepository->update($request->all(), $id);

        Flash::success('Pembayaran updated successfully.');

        return redirect(route('pembayarans.index'));
    }

    /**
     * Remove the specified Pembayaran from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pembayaran = $this->pembayaranRepository->find($id);

        if (empty($pembayaran)) {
            Flash::error('Pembayaran not found');

            return redirect(route('pembayarans.index'));
        }

        $this->pembayaranRepository->delete($id);

        Flash::success('Pembayaran deleted successfully.');

        return redirect(route('pembayarans.index'));
    }

    public function report(Request $request)
    {
        $filter = $request->filter_pilihan;
        $filter_jenis = $request->filter_jenis;
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;

        switch($filter) {
            case 'jenis_bayar':
                $result = Pembayaran::with(['bio_siswa','jenis_bayar', 'jenis_produk_bayar'])->whereBetween('tgl_pembayaran', [$tgl_mulai, $tgl_akhir])->where('id_jenis_bayar', $filter_jenis)->get();
                break;
            case 'jenis_produk':
                $result = Pembayaran::with(['bio_siswa','jenis_bayar', 'jenis_produk_bayar'])->whereBetween('tgl_pembayaran', [$tgl_mulai, $tgl_akhir])->where('id_produk_bayar', $filter_jenis)->get();
                break;
            default:
                'error';
                break;
        }

        return view('pembayarans.report', compact('result', 'tgl_mulai', 'tgl_akhir'));

    }

    public function getJenis(Request $request)
    {
        switch ($request->jenis) {
            case 'jenis_bayar':
                $result = $this->jenisBayarRepository->pluck('jenis_bayar', 'id_jenis');
                return response()->json($result);
                break;
            case 'jenis_produk':

        }
    }
}
