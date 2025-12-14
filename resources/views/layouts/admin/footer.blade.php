<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <!-- Bagian Hak Cipta -->
        <div class="copyright text-center my-3">
            <span>Copyright &copy; SIPEDES - Sistem Informasi Pemerintahan Desa {{ date('Y') }}</span>
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Bagian Identitas Pengembang -->
        <div class="developer-section mt-4 pt-3 border-top">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <h6 class="text-center mb-4 text-secondary">Dikembangkan oleh:</h6>
                    
                    <div class="card developer-card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Foto Pengembang dari folder public/assets/img -->
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    <div class="developer-photo-container mx-auto">
                                        <!-- Gambar dari folder assets/img -->
                                        <img src="{{ asset('assets/images/profile/developer.jpeg') }}" 
                                             alt="Foto Pengembang SIPEDES" 
                                             class="img-fluid rounded-circle border developer-photo"
                                             onerror="this.onerror=null; this.src='{{ asset('assets/img/default-avatar.png') }}'">
                                        <p class="small text-muted mt-2">Foto Pengembang</p>
                                    </div>
                                </div>
                                
                                <!-- Informasi Pengembang -->
                                <div class="col-md-5 mb-3 mb-md-0">
                                    <div class="developer-info">
                                        <h5 class="developer-name mb-2">Febby Fahrezy</h5>
                                        <p class="mb-1"><i class="fas fa-id-badge me-2"></i> NIM: 2457301054</p>
                                        <p class="mb-1"><i class="fas fa-graduation-cap me-2"></i> Prodi: Sistem Informasi</p>
                                        <p class="mb-1"><i class="fas fa-university me-2"></i> Politeknik Caltex Riau</p>
                                        <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Kota Pekznbaru, Riau</p>
                                    </div>
                                </div>
                                
                                <!-- Sosial Media & Teknologi -->
                                <div class="col-md-4">
                                    <div class="social-links">
                                        <h6 class="mb-3">Hubungi Saya:</h6>
                                        <div class="d-flex flex-wrap justify-content-center justify-content-md-start">
                                            <a href="https://linkedin.com/in/ahmad-fauzi" 
                                               class="social-btn linkedin me-2 mb-2" 
                                               target="_blank" 
                                               title="LinkedIn">
                                                <i class="fab fa-linkedin"></i>
                                                <span class="d-none d-md-inline"> LinkedIn</span>
                                            </a>
                                            <a href="https://github.com/febby24si-create" 
                                               class="social-btn github me-2 mb-2" 
                                               target="_blank" 
                                               title="GitHub">
                                                <i class="fab fa-github"></i>
                                                <span class="d-none d-md-inline"> GitHub</span>
                                            </a>
                                            <a href="https://www.instagram.com/x.rezy_?igsh=czhjbm5oYXN2NXJ5" 
                                               class="social-btn instagram me-2 mb-2" 
                                               target="_blank" 
                                               title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                                <span class="d-none d-md-inline"> Instagram</span>
                                            </a>
                                            <a href="mailto:febby24si@mahasiswa.pcr.ac.id" 
                                               class="social-btn email me-2 mb-2" 
                                               title="Email">
                                                <i class="fas fa-envelope"></i>
                                                <span class="d-none d-md-inline"> Email</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Catatan dan Lisensi -->
                    <div class="text-center text-muted small mt-3">
                        <p class="mb-1">
                            <i class="fas fa-code me-1"></i> 
                            Sistem ini dikembangkan sebagai Tugas Akhir Proyek Sistem Informasi Pemerintahan Desa.
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            Versi 1.0.0 | Terakhir diperbarui: {{ date('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
