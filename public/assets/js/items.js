 // Fungsi pencarian tabel
    function searchTable() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let rows = document.querySelectorAll("#itemTable tr");
      rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
      });
    }

    // Isi form edit berdasarkan data item
    document.addEventListener('DOMContentLoaded', function () {
      const editButtons = document.querySelectorAll('.btn-edit');
      const form = document.getElementById('editForm');
      const nameInput = form.querySelector('input[name="item_name"]');
      const priceInput = form.querySelector('input[name="price"]');

      editButtons.forEach(button => {
        button.addEventListener('click', function () {
          const id = this.dataset.id;
          const name = this.dataset.name;
          const price = this.dataset.price;

          nameInput.value = name;
          priceInput.value = price;
          form.action = `/items/${id}`;
        });
      });
    });

    // Animasi alert custom
    document.addEventListener('DOMContentLoaded', () => {
      const alerts = document.querySelectorAll('.custom-alert');

      alerts.forEach(alert => {
        setTimeout(() => {
          alert.classList.add('show');
        }, 100);

        setTimeout(() => {
          alert.classList.remove('show');
          alert.classList.add('hide');
        }, 5100);

        setTimeout(() => {
          alert.remove();
        }, 5600);
      });
    });