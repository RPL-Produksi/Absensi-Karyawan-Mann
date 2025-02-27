<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin Ingin Keluar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Pilih "Keluar" di bawah jika Anda siap mengakhiri sesi Anda saat ini.
            </div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</div>
