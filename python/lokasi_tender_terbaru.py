import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

cursor.execute("SELECT url,kode_tender,lokasi_tender_baru_kosong.id_lpse FROM lokasi_tender_baru_kosong,lpse WHERE lokasi_tender_baru_kosong.id_lpse=lpse.id_lpse ORDER BY RAND()")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[0])
    kode_tender = paket[1]
    detil = lpse.detil_paket_tender(id_paket=kode_tender)
    det_pengumuman = detil.get_pengumuman()
    det_jadwal = detil.get_jadwal()
    tender = {}
    
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
    
    tender['lokasi_pekerjaan'] = det_pengumuman['lokasi_pekerjaan'][0]
    tender['tgl_pembuatan'] = tgl_pembuatan
    
    for tahap in det_jadwal:
        if tahap['tahap'] == 'Pengumuman Prakualifikasi' or tahap['tahap'] == 'Pengumuman Pascakualifikasi':
            mulai = tahap['mulai'].split()
            mulai = mulai[2]+'-'+bulan[mulai[1]]+'-'+mulai[0]+' '+mulai[3]
            tender['tgl_pembuatan'] = mulai
            break
    
    #update tender terbaru
    try:
        sql = ("UPDATE tender_terbaru SET lokasi_pekerjaan=%(lokasi_pekerjaan)s, tgl_pembuatan=%(tgl_pembuatan)s WHERE kode_tender="+str(kode_tender))
                        
        cursor.execute(sql, tender)
        koneksi.commit()
    except Exception as e:
        print("Error: ", e)
        koneksi.rollback()

cursor.close()
koneksi.close()