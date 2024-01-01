<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal dengan jQuery</title>
    <!-- Sertakan library jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Sertakan library Bootstrap untuk modal -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Tombol -->
<button type="button" class="btn btn-primary" id="tombol">Klik Saya</button>

<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nilai dari Tombol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Tempat untuk menampilkan nilai -->
        <p id="nilaiTombol"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Script jQuery -->
<script>
    $(document).ready(function(){
        // Tangani klik pada tombol
        $("#tombol").click(function(){
            // Ambil nilai dari tombol
            var nilai = $(this).text();
            
            // Tampilkan nilai di modal
            $("#nilaiTombol").text("Nilai dari tombol adalah: " + nilai);

            // Tampilkan modal
            $("#myModal").modal('show');
        });
    });
</script>

</body>
</html>
