<!-- Custom Modal Structure -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.3s ease;">
    <div style="background: #fff; border: 2px solid #000; padding: 30px; max-width: 400px; width: 100%; text-align: center; animation: appear 0.3s ease-out;">
        <h2 style="margin-top: 0; text-transform: uppercase;">Konfirmasi Hapus</h2>
        <p style="font-weight: 700; margin-bottom: 30px;">Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.</p>
        <div style="display: flex; gap: 10px; justify-content: center;">
            <button type="button" onclick="closeDeleteModal()" style="background: #fff; color: #000; border: 2px solid #000; padding: 10px 20px; font-weight: 900; text-transform: uppercase; cursor: pointer;">Batal</button>
            <button type="button" id="confirmDeleteBtn" style="background: #e11d48; color: #fff; border: 2px solid #000; padding: 10px 20px; font-weight: 900; text-transform: uppercase; cursor: pointer;">Hapus</button>
        </div>
    </div>
</div>

<script>
    let formToSubmit = null;

    function openDeleteModal(form) {
        formToSubmit = form;
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'flex';
        setTimeout(() => { modal.style.opacity = '1'; }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.style.opacity = '0';
        setTimeout(() => { modal.style.display = 'none'; }, 300);
        formToSubmit = null;
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (formToSubmit) formToSubmit.submit();
    });
</script>