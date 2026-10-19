<script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/main.js') }}?v={{ @filemtime(public_path('admin/assets/js/main.js')) ?: time() }}"></script>

 <script>
  document.addEventListener("DOMContentLoaded", function () {

    const dropdownButtons = document.querySelectorAll(".cms-dropdown-btn");

    dropdownButtons.forEach(function (btn) {

        btn.addEventListener("click", function () {

            const dropdown = btn.closest(".cms-dropdown");

            if (dropdown) {
                dropdown.classList.toggle("active");
            }

        });

    });

});
</script>