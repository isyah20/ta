<style>
.npwp-alert-msg .btn-close {
    top: 0;
    right: 0;
    z-index: 2;
    padding: 1.25rem 1rem;
}
</style>
<section class="profile" style="min-height: 100vh;">
    <div class=" container-fluid profile-sampul py-5" style="padding:0px; overflow-x:hidden">
        <img class="w-100" src="<?= base_url("assets/img/banner_profile.png") ?>" alt="">
        <div class="col-lg-12" style="margin-top:-170px">
            <div class="row justify-content-center">

                <div class="col-11 col-lg-8 bg-white rounded-3 p-3 mx-3 mb-5" id="form-profile-tab">
                    <div class="d-flex justify-content-between p-2 border-bottom">
                        <h3 class="fs-3 m-0" id="defaultOpen">Lengkapi Profil</h3>
                    </div>

                    <div class="p-3 col-lg-11 mx-auto" x-data="npwp">
                        <form action="<?= base_url('lengkapi-profile') ?>" method="post" class="form-profile profile">
                            <div :class="npwpAlertClass" x-show="showAlert">
                                <div x-text="alertMsg"></div>
                                <button class="btn-close position-absolute" type="button" aria-label="Close" @click="hideAlert()"></button>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-4 col-xl-3 col-form-label">Nomor Npwp<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="text" name="npwp" x-model="npwp" x-mask="99.999.999.9-999.999"
                                    placeholder="##.###.###.#-###.###"
                                    @keyup="validateNpwp()" :class="errors.npwp ? 'form-control is-invalid' : 'form-control'">
                                    <p class="small text-danger" x-text="msg.npwp" style="display: none" x-show="errors.npwp"></p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-xl-3 col-form-label">&nbsp;</label>
                                <div class="col-sm-8 col-xl-9">
                                    <button type="button" class="btn btn-danger px-3 m-1 btn-update" x-text="loading ? 'Menyimpan...' : 'Simpan'" @click="saveNpwp($event)">Perbaharui</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
<script defer src="<?= base_url() ?>assets/js/alpine-3.12.0.js"></script>
<script>
const userId = '<?= $userId ?>';
document.addEventListener('alpine:init', () => {
    Alpine.data('npwp', () => ({
        npwp: '',
        errors: {
            npwp: null,
        },
        msg: {
            npwp: null,
        },
        loading: false,
        token: '',
        npwpAlertClass: '',
        showAlert: false,
        alertMsg: '',
        init () {
            this.$watch('npwp', (newVal, oldVal) => {
                this.errors.npwp = !this.validateNpwp()
            })
            this.getToken().then(resp => {
                this.token = resp
                $.ajax({
                    url: `${base_url}api/pengguna/${userId}`,
                    headers: {
                        'Authorization': 'Basic ' + btoa(`${this.token.key}:${this.token.token}`)
                    }
                })
                .done(resp => {
                    console.log(resp)
                })
                .fail(err => console.log(err))
            })
            .catch(err => console.log(err))
        },
        hideAlert () {},
        getToken () {
            if (this.token == null) {
                return new Promise((resolve, reject) => {
                    $.ajax({ url: `${base_url}pengguna/get-token`})
                        .done(resp => resolve(resp))
                        .fail(err => reject(err))
                })
            }
            return new Promise((resolve, reject) => resolve(this.token))
        },
        validateNpwp () {
            const valLength = this.npwp.length > 0 && this.npwp.length <= 20
            if (!valLength) {
                this.msg.npwp = 'Nomor NPWP tidak valid'
            } 
            
            return valLength 
        },
        saveNpwp (evt) {
            $.ajax({
                url: `${base_url}npwp`,
                type: 'POST',
                data: {npwp: this.npwp, user_id: userId},
                dataType: 'json',
                beforeSend: () => {this.loading = true},
            })
            .done(resp => {
                this.loading = false
                this.alertMsg = resp.message
                if (resp.error_code == 0) {
                    this.npwpAlertClass = 'alert alert-success npwp-alert-msg'
                } else {
                    this.npwpAlertClass = 'alert alert-danger npwp-alert-msg'
                }
                this.showAlert = true
                console.log(resp)
            })
            .fail(err => {
                this.loading = false
                console.log(err)
                // this.alertMsg = resp.message
                // if (resp.error_code == 0) {
                //     this.npwpAlertClass = 'alert alert-success'
                // } else {
                //     this.npwpAlertClass = 'alert alert-danger'
                // }
                // this.showAlert = true
            })
            return evt.preventDefault()
        }
    }))
})
</script>
