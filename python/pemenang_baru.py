import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

# cursor.execute("SELECT url,paket.kode_tender,lpse.id_lpse FROM tender_pemenang_kosong,paket,lpse WHERE tender_pemenang_kosong.kode_tender=paket.kode_tender AND paket.id_lpse=lpse.id_lpse ORDER BY RAND()")
cursor.execute("SELECT url,kode_tender,lpse.id_lpse FROM tender_terbaru,lpse WHERE tender_terbaru.id_lpse=lpse.id_lpse ORDER BY RAND() LIMIT 50")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[0])
    kode_tender = paket[1]
    detil = lpse.detil_paket_tender(id_paket=kode_tender)
    det_pengumuman = detil.get_pengumuman()
    det_pemenang = detil.get_pemenang()
    det_jadwal = detil.get_jadwal()
    pemenang = {}
    
    bulan = {
        'Januari': '01',
        'Februari': '02',
        'Maret': '03',
        'April': '04',
        'Mei': '05',
        'Juni': '06',
        'Juli': '07',
        'Agustus': '08',
        'September': '09',
        'Oktober': '10',
        'November': '11',
        'Desember': '12'
    }
    
    tgl_pembuatan = det_pengumuman['tanggal_pembuatan'].split()
    tgl_pembuatan = tgl_pembuatan[2]+'-'+bulan[tgl_pembuatan[1]]+'-'+tgl_pembuatan[0]
    
    tahun_anggaran = det_pengumuman['tahun_anggaran'].split()
    tahun_anggaran = tahun_anggaran[0]+' '+tahun_anggaran[1]
    
    status_tender = ', '.join(det_pengumuman['label_paket'])
    
    jenis_pengadaan = det_pengumuman['jenis_pengadaan']
    if jenis_pengadaan == 'Pengadaan Barang': jenis = '1'
    elif jenis_pengadaan == 'Pekerjaan Konstruksi': jenis = '2'
    elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Non Konstruksi': jenis = '3'
    elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Konstruksi': jenis = '4'
    elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Non Konstruksi': jenis = '5'
    elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Konstruksi': jenis = '6'
    elif jenis_pengadaan == 'Jasa Lainnya': jenis = '7'
    elif jenis_pengadaan == 'Pekerjaan Konstruksi Terintegrasi': jenis = '8'
    
    tahap_tender = det_pengumuman['tahap_tender_saat_ini'].replace(' [...]','')
    sql = "SELECT id_tahap FROM tahap WHERE nama_tahap='"+tahap_tender+"'"
    cursor.execute(sql)
    result = cursor.fetchone()
    id_tahap = str(result[0])
    
    if 'kualifikasi_usaha' in det_pengumuman: kualifikasi_usaha = det_pengumuman['kualifikasi_usaha']
    else: kualifikasi_usaha = ''
    
    if 'bobot_teknis' in det_pengumuman: bobot_teknis = det_pengumuman['bobot_teknis']
    else: bobot_teknis = 0
    
    if 'bobot_biaya' in det_pengumuman: bobot_biaya = det_pengumuman['bobot_biaya']
    else: bobot_biaya = 0
    
    pemenang['kode_tender'] = kode_tender
    pemenang['nama_tender'] = det_pengumuman['nama_tender']
    pemenang['status_tender'] = status_tender
    pemenang['uraian_singkat_pekerjaan'] = ''
    pemenang['id_lpse'] = paket[2]
    pemenang['tanggal_pembuatan'] = tgl_pembuatan
    pemenang['tahap_tender_saat_ini'] = id_tahap
    pemenang['klpd'] = det_pengumuman['k/l/pd']
    pemenang['satuan_kerja'] = det_pengumuman['satuan_kerja']
    pemenang['jenis_tender'] = jenis
    pemenang['metode_pengadaan'] = det_pengumuman['metode_pengadaan']
    pemenang['tahun_anggaran'] = tahun_anggaran
    pemenang['nilai_pagu'] = det_pengumuman['nilai_pagu_paket']
    pemenang['nilai_hps'] = det_pengumuman['nilai_hps_paket']
    pemenang['lokasi_pekerjaan'] = det_pengumuman['lokasi_pekerjaan'][0]
    pemenang['kualifikasi_usaha'] = kualifikasi_usaha
    pemenang['bobot_teknis'] = bobot_teknis
    pemenang['bobot_biaya'] = bobot_teknis
    pemenang['syarat_kualifikasi'] = ''
    pemenang['peserta_tender'] = det_pengumuman['peserta_tender']
    
    if det_pemenang:
        pemenang['npwp'] = det_pemenang[0]['npwp']
        pemenang['nama_pemenang'] = det_pemenang[0]['nama_pemenang']
        alamat = det_pemenang[0]['alamat'].split('-')
        kabupaten = alamat[len(alamat)-2].replace('.','').replace(')','').replace(' (','-')
        kabupaten = kabupaten.split('-')
        pemenang['alamat'] = alamat[0].strip()
        pemenang['kabupaten'] = kabupaten[1]+' '+kabupaten[0]
        pemenang['provinsi'] = alamat[len(alamat)-1].strip()
        pemenang['harga_penawaran'] = det_pemenang[0]['harga_penawaran']
        pemenang['harga_negosiasi'] = det_pemenang[0]['harga_negosiasi']
    else:
        pemenang['npwp'] = ''
        pemenang['nama_pemenang'] = ''
        pemenang['alamat'] = ''
        pemenang['kabupaten'] = ''
        pemenang['provinsi'] = ''
        pemenang['harga_penawaran'] = 0
        pemenang['harga_negosiasi'] = 0
    
    penetapan_pemenang = 0
    for tahap in det_jadwal:
        if tahap['tahap'] == 'Pengumuman Pemenang' or tahap['tahap'] == 'Penetapan dan Pengumuman Pemenang':
            mulai = tahap['mulai'].split()
            mulai = mulai[2]+'-'+bulan[mulai[1]]+'-'+mulai[0]+' '+mulai[3]
            pemenang['tgl_pemenang'] = mulai
            penetapan_pemenang += 1
    
    if penetapan_pemenang == 0:
        # tgl_pembuatan = det_pengumuman['tanggal_pembuatan'].split()
        # tgl_pembuatan = tgl_pembuatan[2]+'-'+bulan[tgl_pembuatan[1]]+'-'+tgl_pembuatan[0]
        pemenang['tgl_pemenang'] = tgl_pembuatan
    
    #update pemenang
    try:
        sql = "SELECT id_pemenang FROM pemenang WHERE kode_tender="+str(kode_tender)
        cursor.execute(sql)
        result = cursor.fetchone()
                
        if result is None:
            try:
                sql_paket = ("INSERT INTO paket VALUES (NULL, %(id_lpse)s, %(kode_tender)s, %(nama_tender)s, %(status_tender)s, %(uraian_singkat_pekerjaan)s, %(tanggal_pembuatan)s, %(tahap_tender_saat_ini)s, %(klpd)s, %(satuan_kerja)s, %(jenis_tender)s, %(metode_pengadaan)s, %(tahun_anggaran)s, %(nilai_pagu)s, %(nilai_hps)s, %(lokasi_pekerjaan)s, %(kualifikasi_usaha)s, %(bobot_teknis)s, %(bobot_biaya)s, %(syarat_kualifikasi)s, %(peserta_tender)s)")
                cursor.execute(sql_paket, pemenang)
                koneksi.commit()
            except Exception as e:
                print("Error: ", e)
                koneksi.rollback()
            
            sql = ("INSERT INTO pemenang VALUES (NULL, %(kode_tender)s, %(nama_tender)s, %(id_lpse)s, %(jenis_tender)s, %(nilai_hps)s, %(lokasi_pekerjaan)s, %(npwp)s, %(nama_pemenang)s, %(alamat)s, %(kabupaten)s, %(provinsi)s, %(harga_penawaran)s, %(harga_negosiasi)s, 0, %(tgl_pemenang)s)")
        else:
            sql = ("UPDATE pemenang SET nama_tender=%(nama_tender)s, id_lpse=%(id_lpse)s, jenis_tender=%(jenis_tender)s, nilai_hps=%(nilai_hps)s, lokasi_pekerjaan=%(lokasi_pekerjaan)s, npwp=%(npwp)s, nama_pemenang=%(nama_pemenang)s, alamat=%(alamat)s, kabupaten=%(kabupaten)s, provinsi=%(provinsi)s, harga_penawaran=%(harga_penawaran)s, tgl_pemenang=%(tgl_pemenang)s WHERE kode_tender="+str(kode_tender))
                        
        cursor.execute(sql, pemenang)
        koneksi.commit()
    except Exception as e:
        print("Error: ", e)
        koneksi.rollback()

cursor.close()
koneksi.close()