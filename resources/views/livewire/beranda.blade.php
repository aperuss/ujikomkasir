<div>
    <div class="container">
        <div class="h1 ms-2 mt-2">Beranda</div>
        <div class="d-flex justify-content-center align-items-center" style="width:80vw; height:80vh ">
            <div class="me-3" style="width: auto; height: auto; ">
                <div class="card mb-3 position-relative" style="width:auto; height:auto; background-color: #0066FF">
                    <span class="fw-bold" style="position: absolute; left:4rem; top:3rem; font-size:60px; color: #FFFFFF">{{ $jumlahProduk }}+</span>
                    <span class="fw-bold" style="position: absolute; left:4rem; top:10rem; font-size:25px; color: #FFFFFF">Produk</span>
                    <img src="{{ asset('imagges/ProdukBeranda.svg') }}" style="width:25rem; padding: 5rem 2rem 2rem 14rem">
                </div>
                <div class="card" style="width:auto; height:auto; background-color: #04CB00">
                    <span class="fw-bold" style="position: absolute; left:4rem; top:2rem; font-size:60px; color: #FFFFFF">{{ $jumlahTransaksi }}+</span>
                    <span class="fw-bold w-40" style="position: absolute; left:1.5rem; top:8rem; font-size:20px; color: #FFFFFF">Rata-rata transaksi <span class="d-flex justify-content-center">perbulan</span></span>
                    <img src="{{ asset('imagges/TransaksiBeranda.svg') }}" style="width:25rem; padding: 5rem 1rem 2rem 14rem">
                </div>
            </div>
            <div class="" style="width: auto; height: auto; ">
                <div class="card mb-3" style="width:auto; height:auto; background-color: #FF8A00">
                    <span class="fw-bold" style="position: absolute; left:4rem; top:3rem; font-size:60px; color: #FFFFFF">{{ $jumlahMember }}+</span>
                    <span class="fw-bold" style="position: absolute; left:4rem; top:10rem; font-size:20px; color: #FFFFFF">Member aktif</span>
                    <img src="{{ asset('imagges/Memberaktif.svg') }}" style="width:23rem; padding: 6rem 1rem 1rem 14rem">
                </div>
                <div class="card" style="width:auto; height:auto; background-color: #FF1212">
                    <span class="fw-bold" style="position: absolute; left:4rem; top:2rem; font-size:60px; color: #FFFFFF">{{ $jumlahKasir }}+</span>
                    <span class="fw-bold" style="position: absolute; left:4rem; top:9rem; font-size:20px; color: #FFFFFF">Petugas aktif</span>
                    <img src="{{ asset('imagges/PetugasAktif.svg') }}" style="width:26rem; padding: 6rem 2rem 1.3rem 14rem">
                </div>
            </div>
        </div>
    </div>
</div>
