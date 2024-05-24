import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

cursor.execute("SELECT lpse.id_lpse,url,kode_tender FROM paket,lpse WHERE paket.id_lpse=lpse.id_lpse")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[1])
    detil = lpse.detil_paket_tender(id_paket=paket[2])
    tender = detil.get_pengumuman()
    pengumuman = {}
    
    tgl_pembuatan = tender['tanggal_pembuatan'].split()
    if tgl_pembuatan[1] == 'Januari': bln = '01'
    elif tgl_pembuatan[1] == 'Februari': bln = '02'
    elif tgl_pembuatan[1] == 'Maret': bln = '03'
    elif tgl_pembuatan[1] == 'April': bln = '04'
    elif tgl_pembuatan[1] == 'Mei': bln = '05'
    elif tgl_pembuatan[1] == 'Juni': bln = '06'
    elif tgl_pembuatan[1] == 'Juli': bln = '07'
    elif tgl_pembuatan[1] == 'Agustus': bln = '08'
    elif tgl_pembuatan[1] == 'September': bln = '09'
    elif tgl_pembuatan[1] == 'Oktober': bln = '10'
    elif tgl_pembuatan[1] == 'November': bln = '11'
    elif tgl_pembuatan[1] == 'Desember': bln = '12'
    tgl_pembuatan = tgl_pembuatan[2]+'-'+bln+'-'+tgl_pembuatan[0]
    
    tahap_tender = tender['tahap_tender_saat_ini'].replace(' [...]','')
    sql = "SELECT id_tahap FROM tahap WHERE nama_tahap='"+tahap_tender+"'"
    cursor.execute(sql)
    result = cursor.fetchone()
    id_tahap = str(result[0])
    
    jenis_pengadaan = tender['jenis_pengadaan']
    if jenis_pengadaan == 'Pengadaan Barang': jenis = '1'
    elif jenis_pengadaan == 'Pekerjaan Konstruksi': jenis = '2'
    elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Non Konstruksi': jenis = '3'
    elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Konstruksi': jenis = '4'
    elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Non Konstruksi': jenis = '5'
    elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Konstruksi': jenis = '6'
    elif jenis_pengadaan == 'Jasa Lainnya': jenis = '7'
    elif jenis_pengadaan == 'Pekerjaan Konstruksi Terintegrasi': jenis = '8'
    
    tahun_anggaran = tender['tahun_anggaran'].split()
    tahun_anggaran = tahun_anggaran[0]+' '+tahun_anggaran[1]
    
    status_tender = ', '.join(tender['label_paket'])
    
    if 'uraian_singkat_pekerjaan' in tender: uraian_singkat_pekerjaan = tender['uraian_singkat_pekerjaan']
    else: uraian_singkat_pekerjaan = ''
    
    if 'kualifikasi_usaha' in tender: kualifikasi_usaha = tender['kualifikasi_usaha']
    else: kualifikasi_usaha = ''
    
    if 'bobot_teknis' in tender: bobot_teknis = tender['bobot_teknis']
    else: bobot_teknis = 0
    
    if 'bobot_biaya' in tender: bobot_biaya = tender['bobot_biaya']
    else: bobot_biaya = 0
    
    pengumuman['id_lpse'] = paket[0]
    pengumuman['kode_tender'] = paket[2]
    pengumuman['nama_tender'] = tender['nama_tender']
    pengumuman['status_tender'] = status_tender
    pengumuman['uraian_singkat_pekerjaan'] = ''
    pengumuman['tanggal_pembuatan'] = tgl_pembuatan
    pengumuman['tahap_tender_saat_ini'] = id_tahap
    pengumuman['klpd'] = tender['k/l/pd']
    pengumuman['satuan_kerja'] = tender['satuan_kerja']
    pengumuman['jenis_pengadaan'] = jenis
    pengumuman['metode_pengadaan'] = tender['metode_pengadaan']
    pengumuman['tahun_anggaran'] = tahun_anggaran
    pengumuman['nilai_pagu_paket'] = tender['nilai_pagu_paket']
    pengumuman['nilai_hps_paket'] = tender['nilai_hps_paket']
    pengumuman['lokasi_pekerjaan'] = tender['lokasi_pekerjaan'][0]
    pengumuman['kualifikasi_usaha'] = kualifikasi_usaha
    pengumuman['bobot_teknis'] = bobot_teknis
    pengumuman['bobot_biaya'] = bobot_teknis
    pengumuman['syarat_kualifikasi'] = ''
    pengumuman['peserta_tender'] = tender['peserta_tender']
    
    try:
        sql = "SELECT kode_tender FROM paket WHERE kode_tender='"+paket[2]+"'"
        cursor.execute(sql)
        result = cursor.fetchone()
        
        if result is None:
            sql = ("INSERT INTO paket VALUES (NULL, %(id_lpse)s, %(kode_tender)s, %(nama_tender)s, %(status_tender)s, %(uraian_singkat_pekerjaan)s, %(tanggal_pembuatan)s, %(tahap_tender_saat_ini)s, %(klpd)s, %(satuan_kerja)s, %(jenis_pengadaan)s, %(metode_pengadaan)s, %(tahun_anggaran)s, %(nilai_pagu_paket)s, %(nilai_hps_paket)s, %(lokasi_pekerjaan)s, %(kualifikasi_usaha)s, %(bobot_teknis)s, %(bobot_biaya)s, %(syarat_kualifikasi)s, %(peserta_tender)s)")
        else:
            sql = ("UPDATE paket SET id_lpse=%(id_lpse)s, nama_tender=%(nama_tender)s, status_tender=%(status_tender)s, uraian_singkat_pekerjaan=%(uraian_singkat_pekerjaan)s, tanggal_pembuatan=%(tanggal_pembuatan)s, tahap_tender_saat_ini=%(tahap_tender_saat_ini)s, klpd=%(klpd)s, satuan_kerja=%(satuan_kerja)s, jenis_pengadaan=%(jenis_pengadaan)s, metode_pengadaan=%(metode_pengadaan)s, tahun_anggaran=%(tahun_anggaran)s, nilai_pagu_paket=%(nilai_pagu_paket)s, nilai_hps_paket=%(nilai_hps_paket)s, lokasi_pekerjaan=%(lokasi_pekerjaan)s, kualifikasi_usaha=%(kualifikasi_usaha)s, bobot_teknis=%(bobot_teknis)s, bobot_biaya=%(bobot_biaya)s, syarat_kualifikasi=%(syarat_kualifikasi)s, peserta_tender=%(peserta_tender)s WHERE kode_tender=%(kode_tender)s")
                
        cursor.execute(sql, pengumuman)
        koneksi.commit()
    except Exception as e:
        print("Error: ", e)
        koneksi.rollback()

cursor.close()
koneksi.close()