import requests
import mysql.connector
from bs4 import BeautifulSoup
from pyproc import Lpse

# koneksi = mysql.connector.connect(
#     host="localhost",
#     user="tenderplus",
#     password="accJp8Dm3z6jPFfc",
#     database="tenderplus"
# )

koneksi = mysql.connector.connect(
    host="dev.swevel.com",
    user="tenderplus",
    password="C%87SfcjjaHb*te",
    database="tenderplus"
)

cursor = koneksi.cursor()

cursor.execute("SELECT CONCAT(url,'#',id_lpse) AS url FROM lpse WHERE id_lpse NOT IN (SELECT id_lpse FROM tender_terbaru WHERE DATE(tgl_update)=CURRENT_DATE GROUP BY id_lpse) ORDER BY RAND()")
daftar_lpse = cursor.fetchall()

for lpse in daftar_lpse:
    link = lpse[0].split('#')[0]
    id_lpse = lpse[0].split('#')[1]

    headers = {'User-Agent': "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246"}
    response = requests.get(url=link, headers=headers)
    if response.status_code == 200:
        soup = BeautifulSoup(response.content, 'html5lib')
        tabel = soup.find("table", class_="table-sm")
        tabel_data = tabel.find_all("tr")
        
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
        
        for row in tabel_data[1:]:  # Melewati baris header
            columns = row.find_all("td")
            if len(columns) > 1:
                jenis_tender = row.get("class")[0].replace('_',' ')
                if jenis_tender == 'Pengadaan Barang': jenis = '1'
                elif jenis_tender == 'Pekerjaan Konstruksi': jenis = '2'
                elif jenis_tender == 'Jasa Konsultansi Badan Usaha Non Konstruksi': jenis = '3'
                elif jenis_tender == 'Jasa Konsultansi Badan Usaha Konstruksi': jenis = '4'
                elif jenis_tender == 'Jasa Konsultansi Perorangan Non Konstruksi': jenis = '5'
                elif jenis_tender == 'Jasa Konsultansi Perorangan Konstruksi': jenis = '6'
                elif jenis_tender == 'Jasa Lainnya': jenis = '7'
                elif jenis_tender == 'Pekerjaan Konstruksi Terintegrasi': jenis = '8'
                
                nama_tender = columns[1].find("a").text.strip()
                hps = columns[2].text.strip().replace('Rp. ','').replace('.','').replace(',','.')
                akhir_daftar = columns[3].text.strip().split()
                akhir_daftar = akhir_daftar[2]+'-'+bulan[akhir_daftar[1]]+'-'+akhir_daftar[0]+' '+akhir_daftar[3]
                url = columns[1].find("a", href=True)
                kode_tender = url['href'].replace('/eproc4/lelang/','').replace('/pengumumanlelang','')
                
                lpse = Lpse(link)
                detil = lpse.detil_paket_tender(id_paket=kode_tender)
                det_pengumuman = detil.get_pengumuman()
                det_jadwal = detil.get_jadwal()
                
                tgl_pembuatan = det_pengumuman['tanggal_pembuatan'].split()
                tgl_pembuatan = tgl_pembuatan[2]+'-'+bulan[tgl_pembuatan[1]]+'-'+tgl_pembuatan[0]
                lokasi = det_pengumuman['lokasi_pekerjaan'][0]
                
                for tahap in det_jadwal:
                    if tahap['tahap'] == 'Pengumuman Prakualifikasi' or tahap['tahap'] == 'Pengumuman Pascakualifikasi':
                        mulai = tahap['mulai'].split()
                        mulai = mulai[2]+'-'+bulan[mulai[1]]+'-'+mulai[0]+' '+mulai[3]
                        tgl_pembuatan = mulai
                        break
                
                data = {
                    'id_lpse': id_lpse,
                    'kode_tender': kode_tender,
                    'jenis_pengadaan': jenis,
                    'nama_tender': nama_tender,
                    'hps': hps,
                    'lokasi_pekerjaan': lokasi,
                    'tgl_pembuatan': tgl_pembuatan,
                    'akhir_daftar': akhir_daftar
                }
                
                try:
                    sql = "SELECT kode_tender FROM tender_terbaru WHERE kode_tender="+kode_tender
                    cursor.execute(sql)
                    result = cursor.fetchone()
                
                    if result is None:
                        sql = ("INSERT INTO tender_terbaru VALUES (NULL, %(id_lpse)s, %(kode_tender)s, %(jenis_pengadaan)s, %(nama_tender)s, %(hps)s, %(lokasi_pekerjaan)s, %(tgl_pembuatan)s, %(akhir_daftar)s, CURRENT_DATE)")
                    else:
                        sql = ("UPDATE tender_terbaru SET id_lpse=%(id_lpse)s, jenis_pengadaan=%(jenis_pengadaan)s, nama_tender=%(nama_tender)s, hps=%(hps)s, lokasi_pekerjaan=%(lokasi_pekerjaan)s, tgl_pembuatan=%(tgl_pembuatan)s, akhir_daftar=%(akhir_daftar)s, tgl_update=CURRENT_DATE WHERE kode_tender=%(kode_tender)s")
                    
                    cursor.execute(sql, data)
                    koneksi.commit()
                except Exception as e:
                    print("Error: ", e)
                    koneksi.rollback()

cursor.close()
koneksi.close()