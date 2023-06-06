</div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	$('#id_poli').change(function() { 
		var poli = $(this).val(); 
		$.ajax({
			type: 'POST', 
			url: 'get_dokter.php', 
			data: 'id_poli=' + poli, 
			success: function(response) { 
				$('#kode_dokter').html(response); 
			}
		});
	});
 
</script>

<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/pages/horizontal-layout.js"></script>

<script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard.js"></script>


<!-- DataTable -->
<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="assets/js/pages/datatables.js"></script>


<script src="assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="assets/js/pages/form-element-select.js"></script>

<script>
  // Fungsi untuk menampilkan formulir dan menyimpan status dalam cookie
  function showForm() {
    var formContainer = document.getElementById('formContainer');
    formContainer.style.display = 'block';
    document.cookie = "formDisplayed=true";
  }

  // Cek apakah cookie formDisplayed bernilai true
  var formCookie = document.cookie.match(/(^|;) ?formDisplayed=([^;]*)(;|$)/);
  if (formCookie && formCookie[2] === "true") {
    var formContainer = document.getElementById('formContainer');
    formContainer.style.display = 'block';
  }
</script>

<script>
  function toggleBPJSInput() {
    var statusPasien = document.getElementById("status_pasien").value;
    var bpjsInput = document.getElementById("no-bpjs-input");
    var noBPJSInput = document.getElementById("no_bpjs");

    if (statusPasien === "bpjs") {
      bpjsInput.style.display = "block";
      noBPJSInput.setAttribute("required", "required");
      noBPJSInput.removeAttribute("readonly");
      noBPJSInput.value = "";
    } else if (statusPasien === "umum") {
      bpjsInput.style.display = "block";
      noBPJSInput.setAttribute("readonly", "readonly");
      noBPJSInput.value = "-";
      noBPJSInput.removeAttribute("required");
      noBPJSInput.disabled = true;
    }
  }
</script>

</body>

</html>