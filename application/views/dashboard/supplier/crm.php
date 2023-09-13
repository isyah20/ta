<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
    .container-fluid {
      display: flex;
      justify-content: flex-start;
         /* Mengatur kontainer agar sejajar ke kiri */
      overflow-x: hidden; 
        /* Mengaktifkan overflow horizontal jika kontainer melebihi lebar layar */
    }
    .box {
      display: inline-block; /* Menjadikan kotak inline block */
      margin-right: 0; /* Menghapus margin-right untuk menghapus jarak antara kontainer */
      border: none; /* Menghapus border */
      border-radius: 5px;
      min-width: 250px; /* Mengatur lebar minimum untuk mencegah kontainer terlalu kecil */
      height: 400px;
      max-height: calc(100vh - 40px); /* Mengatur tinggi maksimal untuk kontainer */
      overflow-y: auto;
    }
    .box .card {
      width: 250px; /* Mengatur lebar kartu 100% minus 50px untuk jarak 25px di setiap sisi kartu */
      height: 60px; /* Anda dapat menyesuaikan tinggi kartu sesuai kebutuhan Anda */
      background-color: white;
      color: black;
      border-radius: 5px;
      cursor: grab;
      margin:10px;
    }
    .card p {
    margin: 0;
    padding: 3px 3px 0px 3px ;
  }
  .red {
    background-color: #ebcffc;
  }

  .green {
    background-color: #fec1c1;
  }

  .blue {
    background-color: #f8f5bd;
  }

  .orange {
    background-color: #d0e9f9;
  }

  .purple {
    background-color: purple;
  }

  .card.dragging {
    opacity: 0.5;
    cursor: grab;
  }

  .box .card:active {
    background-color: #3498db; /* Warna latar belakang tetap sama saat kartu di-drag */
  }

  /* Menambahkan titik berukuran lebih besar */
  .box h4 {
    position: relative; /* Menjadikan posisi relatif untuk judul */
    padding-left: 30px;
  }

  .box h4::before { 
    content: "•"; /* Karakter titik */
    margin-top: 4px;
    margin-right: 5px; /* Jarak antara titik dan judul */
    font-size: 40px; /* Ukuran font titik lebih besar */
    position: absolute; /* Menjadikan posisi absolut untuk titik */
    left: 12px; /* Titik sejajar dengan judul */
    top: 50%; /* Titik sejajar dengan judul secara vertikal */
    transform: translateY(
      -50%
    ); 
  }

  /* Memberikan warna berbeda untuk setiap kontainer */
  #container2 h4::before {
    color: #e74c3c;}

  #container3 h4::before {
    color: #27ae60;}

  #container4 h4::before {
    color: #3498db;}

  #container5 h4::before {
    color: #f39c12;}

  #container1 h4::before {
    color: #8e44ad;}
  </style>

<section class="py-5">
  <div class="mt-5 px-5">
    <h3>Selamat Datang!</h3>
    <h3>Yuk Segera Bagi Tugas Tim Marketingmu</h3>
  </div>
  <div class="col-md-3 pt-3 px-5">
   <button class="btn btn-primary" id="addContainerBtn">Tambahkan Anggota</button>
  </div>
</section>
<section>

<div class="container-fluid pb-4 mx-4" id="scroll-marker">
  <div class="row">
    <div class="col">
        <div id="container1" style="height:1200px" class="box red" data-number="1">
            <h4 class="pt-2">Perusahaan</h4>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
              <div class="card" draggable="true">
                <p>PT Cahaya Asia Ya Putra Dewa</p>
                <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
              </div>
            </div>
        </div>
      
    </div>
    <div class="col">
      <div class="row">
          <div class="col">
            <div class="mx-3">
              <div id="container2" class="box green" data-number="2">
                <h4 class="pt-2">Container 2</h4>
                <div class="card" draggable="true">
                  <p>Card 2</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mx-3">
              <div id="container3" class="box blue" data-number="3">
                <h4 class="pt-2">Container 3</h4>
                <div class="card" draggable="true">
                  <p>Card 3</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mx-3">
                <div id="container3" class="box blue" data-number="3">
                  <h4 class="pt-2">Container 3</h4>
                  <div class="card" draggable="true">
                    <p>Card 3</p>
                  </div>
                </div>
            </div>
          </div>
          <div class="col">
          <div class="mx-3">
            <div id="container2" class="box green" data-number="2">
              <h4 class="pt-2">Container 2</h4>
              <div class="card" draggable="true">
                <p>Card 2</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mx-3">
            <div id="container2" class="box green" data-number="2">
              <h4 class="pt-2">Container 2</h4>
              <div class="card" draggable="true">
                <p>Card 2</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mx-3">
            <div id="container2" class="box green" data-number="2">
              <h4 class="pt-2">Container 2</h4>
              <div class="card" draggable="true">
                <p>Card 2</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mx-3">
            <div id="container2" class="box green" data-number="2">
              <h4 class="pt-2">Container 2</h4>
              <div class="card" draggable="true">
                <p>Card 2</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mx-3">
            <div id="container2" class="box green" data-number="2">
              <h4 class="pt-2">Container 2</h4>
              <div class="card" draggable="true">
                <p>Card 2</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mx-3">
            <div id="container2" class="box green" data-number="2">
              <h4 class="pt-2">Container 2</h4>
              <div class="card" draggable="true">
                <p>Card 2</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<script>
      const containers = document.querySelectorAll(".box");
      const cards = document.querySelectorAll(".card");
      let isDragging = false;
      let draggedCard = null;
      let scrollMarker = document.getElementById("scroll-marker"); // Ambil elemen penanda scroll
      let isScrolling = false;

      cards.forEach((card, index) => {
        card.addEventListener("dragstart", () => {
          isDragging = true;
          draggedCard = card;
          card.classList.add("dragging");
        });

        card.addEventListener("dragend", () => {
          isDragging = false;
          draggedCard.classList.remove("dragging");
          draggedCard = null;
        });
      });

      containers.forEach((container) => {
        container.addEventListener("dragover", (e) => {
          e.preventDefault();
          // Memulai pemantauan posisi mouse saat card di atas kontainer
          container.addEventListener("mousemove", handleMouseMove);
        });

        container.addEventListener("drop", () => {
          if (isDragging) {
            container.appendChild(draggedCard);
            updateCardCount(container);
          }
          // Menghentikan pemantauan posisi mouse setelah card di-drop
          container.removeEventListener("mousemove", handleMouseMove);
        });

        // Menambahkan jumlah card awal dan pemantauan perubahan jumlah card
        updateCardCount(container);
        observeCardChanges(container);
      });

      // Fungsi untuk menghitung dan menampilkan jumlah card dalam kontainer
      function updateCardCount(container) {
        const cardsInContainer = container.querySelectorAll(".card");
        const title = container.querySelector("h4");
        const cardCount = cardsInContainer.length;
        title.textContent = `Container ${container.dataset.number} (${
          cardCount || 0
        })`;
      }
s
      // Fungsi untuk memantau perubahan jumlah card dalam kontainer
      function observeCardChanges(container) {
        const observer = new MutationObserver((mutationsList) => {
          updateCardCount(container);
        });

        // Memantau perubahan dalam kontainer (penambahan atau penghapusan elemen card)
        observer.observe(container, { childList: true, subtree: true });
      }

      // Fungsi yang akan dipanggil saat card ditarik di atas kontainer
      function handleMouseMove(event) {
        if (isDragging) {
          // Menyimpan posisi mouse saat card ditarik
          const mouseY = event.clientY;

          // Menentukan jika card ditarik ke bawah area penanda scroll
          const scrollMarkerRect = scrollMarker.getBoundingClientRect();
          if (mouseY >= scrollMarkerRect.top && mouseY <= scrollMarkerRect.bottom) {
            isScrolling = true;
          } else {
            isScrolling = false;
          }
        }
      }

      // Memantau posisi mouse saat mouseup (untuk menghentikan scroll jika sedang berlangsung)
      document.addEventListener("mouseup", () => {
        isScrolling = false;
      });

      // Mengecek apakah perlu scroll dan memindahkan card jika diperlukan
      function checkAndMoveCard() {
        if (isDragging && isScrolling) {
          // Menggulirkan ke kontainer paling kanan jika ditarik ke bawah area penanda scroll
          const lastContainer = containers[containers.length - 1];
          lastContainer.appendChild(draggedCard);
          updateCardCount(lastContainer);
        }
        requestAnimationFrame(checkAndMoveCard);
      }

      // Memulai pengecekan dan pemindahan card
      checkAndMoveCard();

    </script>
