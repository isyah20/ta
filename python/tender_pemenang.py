import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

cursor.execute("SELECT url,kode_tender,tender_pemenang_kosong.id_lpse FROM tender_pemenang_kosong,lpse WHERE tender_pemenang_kosong.id_lpse=lpse.id_lpse ORDER BY RAND()")
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
    
    jenis_pengadaan = det_pengumuman['jenis_pengadaan']
    if jenis_pengadaan == 'Pengadaan Barang': jenis = '1'
    elif jenis_pengadaan == 'Pekerjaan Konstruksi': jenis = '2'
    elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Non Konstruksi': jenis = '3'
    elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Konstruksi': jenis = '4'
    elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Non Konstruksi': jenis = '5'
    elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Konstruksi': jenis = '6'
    elif jenis_pengadaan == 'Jasa Lainnya': jenis = '7'
    elif jenis_pengadaan == 'Pekerjaan Konstruksi Terintegrasi': jenis = '8'
    
    pemenang['nama_tender'] = det_pengumuman['nama_tender']
    pemenang['id_lpse'] = paket[2]
    pemenang['tanggal_pembuatan'] = tgl_pembuatan
    pemenang['jenis_tender'] = jenis
    pemenang['nilai_hps'] = det_pengumuman['nilai_hps_paket']
    pemenang['lokasi_pekerjaan'] = det_pengumuman['lokasi_pekerjaan'][0]
    
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
    else:
        pemenang['npwp'] = ''
        pemenang['nama_pemenang'] = ''
        pemenang['alamat'] = ''
        pemenang['kabupaten'] = ''
        pemenang['provinsi'] = ''
        pemenang['harga_penawaran'] = 0
    
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
        sql = ("UPDATE pemenang SET nama_tender=%(nama_tender)s, id_lpse=%(id_lpse)s, jenis_tender=%(jenis_tender)s, nilai_hps=%(nilai_hps)s, lokasi_pekerjaan=%(lokasi_pekerjaan)s, npwp=%(npwp)s, nama_pemenang=%(nama_pemenang)s, alamat=%(alamat)s, kabupaten=%(kabupaten)s, provinsi=%(provinsi)s, harga_penawaran=%(harga_penawaran)s, tgl_pemenang=%(tgl_pemenang)s WHERE kode_tender="+str(kode_tender))
                        
        cursor.execute(sql, pemenang)
        koneksi.commit()
    except Exception as e:
        print("Error: ", e)
        koneksi.rollback()

cursor.close()
koneksi.close()