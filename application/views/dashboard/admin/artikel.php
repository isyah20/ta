<?php

use Google\Service\CloudAsset\Resource\Assets;

?>
<section id="artikel" class="row" style="margin-left: 0px;">
    <div class="artikel col-lg-3" style="min-height: 100vh; margin-top:1px; background:#F4F4F5; padding: 0px;">
        <div class="d-flex justify-content-between pt-4">
            <div class="btn-group-artikel">
                <a href="#" class="tablinks" onclick="openCity(event,'draft')" id="defaultOpen">Draft</a>
                <a href="#" class="tablinks" style="margin-left: 0px;" onclick="openCity(event,'terunggah')" id="defaultOpen">Terunggah</a>
            </div>
            <a href="#" class="btn-add-artikel">
                <iconify-icon inline icon="material-symbols:add" style="color: #047857;"></iconify-icon>
                Tambah Artikel
            </a>
        </div>
        <div id="draft" class="tabcontent mt-3">
            <table class="judul-draft" style="width: 100%;">
                <tr>
                    <td class="d-flex justify-content-between">
                        <div class="draft">
                            <h3>Judul Judul</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipi...</p>
                            <p class="mt-2 mb-3">2 menit yang lalu</p>
                        </div>
                        <button>
                            <i class="align-self-center icon-draft">
                                <iconify-icon inline icon="simple-line-icons:options-vertical" style="color: #6c6c6c;"></iconify-icon>
                            </i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="d-flex justify-content-between">
                        <div class="draft">
                            <h3>Judul Judul</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipi...</p>
                            <p class="mt-2 mb-3">2 menit yang lalu</p>
                        </div>
                        <button>
                            <i class="align-self-center icon-draft">
                                <iconify-icon inline icon="simple-line-icons:options-vertical" style="color: #6c6c6c;"></iconify-icon>
                            </i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="d-flex justify-content-between">
                        <div class="draft">
                            <h3>Judul Judul</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipi...</p>
                            <p class="mt-2 mb-3">2 menit yang lalu</p>
                        </div>
                        <button>
                            <i class="align-self-center icon-draft">
                                <iconify-icon inline icon="simple-line-icons:options-vertical" style="color: #6c6c6c;"></iconify-icon>
                            </i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="d-flex justify-content-between">
                        <div class="draft">
                            <h3>Judul Judul</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipi...</p>
                            <p class="mt-2 mb-3">2 menit yang lalu</p>
                        </div>
                        <button>
                            <i class="align-self-center icon-draft">
                                <iconify-icon inline icon="simple-line-icons:options-vertical" style="color: #6c6c6c;"></iconify-icon>
                            </i>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
        <div id="terunggah" class="tabcontent mt-3">
            <table class="judul-draft" style="width: 100%;">
                <tr>
                    <td class="d-flex justify-content-between">
                        <div class="draft">
                            <h3>Judul Judul</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipi...</p>
                            <p class="mt-2 mb-3">2 menit yang lalu</p>
                        </div>
                        <button>
                            <i class="align-self-center icon-draft">
                                <iconify-icon inline icon="simple-line-icons:options-vertical" style="color: #6c6c6c;"></iconify-icon>
                            </i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="d-flex justify-content-between">
                        <div class="draft">
                            <h3>Judul Judul</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipi...</p>
                            <p class="mt-2 mb-3">2 menit yang lalu</p>
                        </div>
                        <button>
                            <i class="align-self-center icon-draft">
                                <iconify-icon inline icon="simple-line-icons:options-vertical" style="color: #6c6c6c;"></iconify-icon>
                            </i>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
    </script>
    <div class="col-lg-9 mt-3 px-5 artikel-editor">
        <form action="#">
            <div class="d-flex justify-content-between">
                <h2>Artikel</h2>
                <div class="mx-5 group-button">
                    <button class="btn-draft">Draft</button>
                    <button class="btn-unggah">Unggah</button>
                </div>
            </div>
            <div class="my-3 input-judul">
                <input type="text" placeholder="Masukan Judul" class="editor-judul">
            </div>
            <div class="my-3">
                <div class="d-flex">
                    <div class="listHolder">
                        <ul id="addBtn" class="addBtn list">
                            <li>berita</li>
                        </ul>
                    </div>
                    <button class="btn-kategori" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">kategori</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="candidate">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="add-kategori" data-bs-dismiss="modal" onclick="add_kategori()" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                const divList = document.querySelector('.listHolder');
                const addInput = document.querySelector('#candidate');
                const addBtn = document.querySelector('#add-kategori');

                function addLists() {
                    if (addInput.value === '') {
                        alert('Enter the list name please!!!');
                    } else {
                        const ul = divList.querySelector('ul');
                        const li = document.createElement('li');
                        li.innerHTML = addInput.value;
                        addInput.value = '';
                        ul.appendChild(li);
                        createBtn(li);
                    }
                }

                addBtn.addEventListener('click', () => {
                    addLists();
                });
                addInput.addEventListener('keyup', (event) => {
                    if (event.which === 13) {
                        addLists();
                    }
                });
                const listUl = document.querySelector('.list');
                const lis = listUl.children;

                function createBtn(li) {
                    // create remove button
                    const remove = document.createElement('button');
                    remove.className = 'btn-icon remove';
                    li.appendChild(remove);

                    // // create down button
                    // const down = document.createElement('button');
                    // down.className = 'btn-icon down';
                    // li.appendChild(down);

                    // // create up button
                    // const up = document.createElement('button');
                    // up.className = 'btn-icon up';
                    // li.appendChild(up);

                    return li;
                }

                // loop to add buttons in each li
                for (var i = 0; i < lis.length; i++) {
                    createBtn(lis[i]);
                }
                divList.addEventListener('click', (event) => {
                    if (event.target.tagName === 'BUTTON') {
                        const button = event.target;
                        const li = button.parentNode;
                        const ul = li.parentNode;
                        if (button.className === 'btn-icon remove') {
                            ul.removeChild(li);
                        }
                    }
                });
                // function add_kategori() {
                //     var ul = document.getElementById("addBtn");
                //     var candidate = document.getElementById('candidate');
                //     var li = document.createElement("li");
                //     li.setAttribute('id', candidate.value);
                //     li.setAttribute('onclick', 'removeItem()')
                //     // li.appendChild(document.createTextNode(candidate.value, "asdsad"));
                //     li.appendChild(document.createTextNode(candidate.value));
                //     ul.appendChild(li);
                //     console.log(li)
                // }

                // function removeItem() {
                //     var ul = document.getElementById("addBtn");
                //     var candidate = document.getElementById("candidate");
                //     var item = document.getElementById(candidate.value);
                //     ul.removeChild(item);
                // }
            </script>
            <div class="container upload-file py-5">
                <div class="artikel-empty text-center">
                    <img src="<?= base_url() . 'assets/img/artikel_add.svg' ?>" alt="">
                    <p>Silahkan masukkan file dengan klik button dibawah ini</p>
                </div>
                <div class="text-center">
                    <label for="upload-button">Upload File</label>
                    <input id="upload-button" type='file' onchange="pressed()" id="file" multiple hidden />
                </div>
            </div>
            <div class="my-3">
                <div class="centered">
                    <div class="row row-editor">
                        <div class="editor-container">
                            <input id="artikel" class="editor"></input>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="<?= base_url() . 'assets/js/admin/ckeditor.js' ?>"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('.editor'), {
                    licenseKey: '',
                })
                .then(editor => {
                    window.editor = editor;
                })
                .catch(error => {
                    console.error('Oops, something went wrong!');
                    console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
                    console.warn('Build id: coa34x3s75qc-mzvowbvikn9u');
                    console.error(error);
                });
        </script>
    </div>
</section>