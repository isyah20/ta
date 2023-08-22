#!/www/wwwroot/tenderplus.id/python/28b662d883b6d76fd96e4ddc5e9ba780_venv/bin/python3
import scrapy
import mysql.connector
import time
from scrapy_splash import SplashRequest

class TenderTerbaru(scrapy.Spider):
    name = 'tender_terbaru'
    
    def __init__(self):
        self.koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
        self.cursor = self.koneksi.cursor()
        
    def start_requests(self):
        self.cursor.execute("SELECT CONCAT(url,'#',id_lpse) AS url FROM lpse WHERE id_lpse NOT IN (SELECT id_lpse FROM tender_terbaru WHERE DATE(tgl_update)=CURRENT_DATE GROUP BY id_lpse) ORDER BY RAND()")
        result = self.cursor.fetchall()
        
        urls = []
        for x in result:
            urls.append(x[0])

        for x in urls:
            url = x.split('#')[0]
            id_lpse = x.split('#')[1]
            # print(url)
            # print(id_lpse)
            # yield scrapy.Request(url=get_scrapeops_url(url), callback=self.parse, meta={'id_lpse': id_lpse, 'url_lpse': url})
            # yield scrapy.Request(url, callback=self.parse, headers=HEADERS, meta={'id_lpse': id_lpse, 'url_lpse': url})
            # yield SplashRequest(url, callback=self.parse, args={'wait': 0.5, 'viewport': '1024x2480', 'timeout': 90, 'images': 0, 'resource_timeout': 10}, meta={'id_lpse': id_lpse, 'url_lpse': url})
            yield scrapy.Request(url, callback=self.parse, meta={'id_lpse': id_lpse, 'url_lpse': url})
    
    def parse(self, response):
        if (response.status == 200):
            id_lpse = response.meta.get('id_lpse')
            url_lpse = response.meta.get('url_lpse')
            rows = response.css('div.card.card-primary > table > tbody > tr')
            
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
            
            for i in range(1, len(rows)+1):
                jml_pekerjaan = response.css('div.card.card-primary > table > tbody > tr:nth-child('+str(i)+') > td.bs-callout-info > span.badge.badge-secondary.float-right::text').get()
                
                if jml_pekerjaan is not None and int(jml_pekerjaan) > 0:
                    jenis_tender = response.css('div.card.card-primary > table > tbody > tr:nth-child('+str(i)+') > td.bs-callout-info > a::text').get()
                    if jenis_tender == 'Pengadaan Barang': jenis = '1'
                    elif jenis_tender == 'Pekerjaan Konstruksi': jenis = '2'
                    elif jenis_tender == 'Jasa Konsultansi Badan Usaha Non Konstruksi': jenis = '3'
                    elif jenis_tender == 'Jasa Konsultansi Badan Usaha Konstruksi': jenis = '4'
                    elif jenis_tender == 'Jasa Konsultansi Perorangan Non Konstruksi': jenis = '5'
                    elif jenis_tender == 'Jasa Konsultansi Perorangan Konstruksi': jenis = '6'
                    elif jenis_tender == 'Jasa Lainnya': jenis = '7'
                    elif jenis_tender == 'Pekerjaan Konstruksi Terintegrasi': jenis = '8'
                    
                    for j in range(1, int(jml_pekerjaan)+1):
                        index = i + j
                        elm = 'div.card.card-primary > table > tbody > tr:nth-child('+str(index)+') > '
                        
                        nama_tender = response.css(elm + 'td:nth-child(2) > a::text').get()
                        hps = response.css(elm + 'td.table-hps::text').get().strip().replace('Rp. ','').replace('.','').replace(',','.')
                        akhir_daftar = response.css(elm + 'td.center::text').get().split()
                            
                        akhir_daftar = akhir_daftar[2]+'-'+bulan[akhir_daftar[1]]+'-'+akhir_daftar[0]+' '+akhir_daftar[3]
                        url = response.css(elm + 'td:nth-child(2) > a::attr(href)').get()
                        url_detail = url_lpse.replace('/eproc4','')+url
                        kode_tender = url.replace('/eproc4/lelang/','').replace('/pengumumanlelang','')
                        
                        data = {
                            'id_lpse': id_lpse,
                            'kode_tender': kode_tender,
                            'jenis_pengadaan': jenis,
                            'nama_tender': nama_tender,
                            'hps': hps,
                            'akhir_daftar': akhir_daftar
                        }
                        
                        try:
                            sql = "SELECT kode_tender FROM tender_terbaru WHERE kode_tender="+kode_tender
                            self.cursor.execute(sql)
                            result = self.cursor.fetchone()
                        
                            if result is None:
                                sql = ("INSERT INTO tender_terbaru VALUES (NULL, %(id_lpse)s, %(kode_tender)s, %(jenis_pengadaan)s, %(nama_tender)s, %(hps)s, %(akhir_daftar)s, CURRENT_DATE)")
                            else:
                                sql = ("UPDATE tender_terbaru SET id_lpse=%(id_lpse)s, jenis_pengadaan=%(jenis_pengadaan)s, nama_tender=%(nama_tender)s, hps=%(hps)s, akhir_daftar=%(akhir_daftar)s, tgl_update=CURRENT_DATE WHERE kode_tender=%(kode_tender)s")
                            
                            self.cursor.execute(sql, data)
                            self.koneksi.commit()
                        except Exception as e:
                            print("Error: ", e)
                            self.koneksi.rollback()
                        
                        # yield SplashRequest(url_detail, callback=self.parse_detail, args={'wait': 0.2}, meta={'id_lpse': id_lpse, 'kode_tender': kode_tender, 'url_lpse': url_lpse})
        
    def parse_detail(self, response):
        id_lpse = response.meta.get('id_lpse')
        kode_tender = response.meta.get('kode_tender')
        url_lpse = response.meta.get('url_lpse')
        rows_detail = response.css('#main > div > table > tbody > tr')
        
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
        
        detail_tender = {}
        for m in range(1, len(rows_detail)+1):
            elm = '#main > div > table > tbody > tr:nth-child('+str(m)+') > '
            
            label = response.css(elm + 'th::text').get().lower().replace(' ','_').replace('/','')
            if label == 'kode_tender':
                value = response.css(elm + 'td > strong::text').get()
            elif label == 'nama_tender':
                value = response.css(elm + 'td > strong::text').get().strip()
                detail_tender[label] = value
                label = 'status_tender'
                value = response.css(elm + 'td > .badge::text').getall()
            elif label == 'uraian_singkat_pekerjaan':
                value = ''
                # value = url_lpse.replace('/eproc4','')+response.css(elm + 'td > a::attr(href)').get()
            elif label == 'tanggal_pembuatan':
                value = response.css(elm + 'td::text').get().split()'''
                '''if value[1] == 'Januari': bln = '01'
                elif value[1] == 'Februari': bln = '02'
                elif value[1] == 'Maret': bln = '03'
                elif value[1] == 'April': bln = '04'
                elif value[1] == 'Mei': bln = '05'
                elif value[1] == 'Juni': bln = '06'
                elif value[1] == 'Juli': bln = '07'
                elif value[1] == 'Agustus': bln = '08'
                elif value[1] == 'September': bln = '09'
                elif value[1] == 'Oktober': bln = '10'
                elif value[1] == 'November': bln = '11'
                elif value[1] == 'Desember': bln = '12''''
                    
                '''value = value[2]+'-'+bulan[value[1]]+'-'+value[0]
            elif label == 'tahap_tender_saat_ini':
                value = response.css(elm + 'td > a::text').get().replace(' [...]','')
            elif label == 'jenis_pengadaan':
                value = response.css(elm + 'td::text').get()
                if value == 'Pengadaan Barang': jenis = '1'
                elif value == 'Pekerjaan Konstruksi': jenis = '2'
                elif value == 'Jasa Konsultansi Badan Usaha Non Konstruksi': jenis = '3'
                elif value == 'Jasa Konsultansi Badan Usaha Konstruksi': jenis = '4'
                elif value == 'Jasa Konsultansi Perorangan Non Konstruksi': jenis = '5'
                elif value == 'Jasa Konsultansi Perorangan Konstruksi': jenis = '6'
                elif value == 'Jasa Lainnya': jenis = '7'
                elif value == 'Pekerjaan Konstruksi Terintegrasi': jenis = '8'
                
                value = jenis
            elif label == 'tahun_anggaran':
                value = response.css(elm + 'td::text').get().strip().split()
                value = value[0]+' '+value[1]
            elif label == 'nilai_pagu_paket':
                value = response.css(elm + 'td:nth-child(2)::text').get().strip().replace('Rp. ','').replace('.','').replace(',','.')
                detail_tender[label] = value
                label = 'nilai_hps_paket'
                value = response.css(elm + 'td:nth-child(4)::text').get().strip().replace('Rp. ','').replace('.','').replace(',','.')
            elif label == 'lokasi_pekerjaan':
                value = response.css(elm + 'td > ul > li::text').get().strip()
            elif label == 'syarat_kualifikasi':
                value = ''
                # value = response.css(elm + 'td').get().replace('\t',' ').replace('\n ','')
                # value = value.replace('\n','<br/>')
            elif label == 'peserta_tender':
                value = response.css(elm + 'td::text').get().replace(' peserta','')
            else:
                value = response.css(elm + 'td::text').get().strip()
                
            detail_tender[label] = value
            
        status_tender = ', '.join(detail_tender['status_tender'])
        # if 'uraian_singkat_pekerjaan' in detail_tender: uraian_singkat_pekerjaan = detail_tender['uraian_singkat_pekerjaan']
        # else: uraian_singkat_pekerjaan = ''
        if 'kualifikasi_usaha' in detail_tender: kualifikasi_usaha = detail_tender['kualifikasi_usaha']
        else: kualifikasi_usaha = ''
        if 'bobot_teknis' in detail_tender: bobot_teknis = detail_tender['bobot_teknis']
        else: bobot_teknis = 0
        if 'bobot_biaya' in detail_tender: bobot_biaya = detail_tender['bobot_biaya']
        else: bobot_biaya = 0
        
        data_detail = {
            'id_lpse': id_lpse,
            'kode_tender': detail_tender['kode_tender'],
            'nama_tender': detail_tender['nama_tender'],
            'status_tender': status_tender,
            'uraian_singkat_pekerjaan': uraian_singkat_pekerjaan,
            'tanggal_pembuatan': detail_tender['tanggal_pembuatan'],
            'tahap_tender_saat_ini': detail_tender['tahap_tender_saat_ini'],
            'klpd': detail_tender['klpd'],
            'satuan_kerja': detail_tender['satuan_kerja'],
            'jenis_pengadaan': detail_tender['jenis_pengadaan'],
            'metode_pengadaan': detail_tender['metode_pengadaan'],
            'tahun_anggaran': detail_tender['tahun_anggaran'],
            'nilai_pagu_paket': detail_tender['nilai_pagu_paket'],
            'nilai_hps_paket': detail_tender['nilai_hps_paket'],
            'lokasi_pekerjaan': detail_tender['lokasi_pekerjaan'],
            'kualifikasi_usaha': kualifikasi_usaha,
            'bobot_teknis': bobot_teknis,
            'bobot_biaya': bobot_biaya,
            'syarat_kualifikasi': detail_tender['syarat_kualifikasi'],
            'peserta_tender': detail_tender['peserta_tender']
        }
                
        try:
            sql = "SELECT kode_tender FROM paket WHERE kode_tender="+kode_tender
            self.cursor.execute(sql)
            result = self.cursor.fetchone()
            
            if result is None:
                sql = ("INSERT INTO paket VALUES (NULL, %(id_lpse)s, %(kode_tender)s, %(nama_tender)s, %(status_tender)s, %(uraian_singkat_pekerjaan)s, %(tanggal_pembuatan)s, %(tahap_tender_saat_ini)s, %(klpd)s, %(satuan_kerja)s, %(jenis_pengadaan)s, %(metode_pengadaan)s, %(tahun_anggaran)s, %(nilai_pagu_paket)s, %(nilai_hps_paket)s, %(lokasi_pekerjaan)s, %(kualifikasi_usaha)s, %(bobot_teknis)s, %(bobot_biaya)s, %(syarat_kualifikasi)s, %(peserta_tender)s)")
            else:
                sql = ("UPDATE paket SET id_lpse=%(id_lpse)s, nama_tender=%(nama_tender)s, status_tender=%(status_tender)s, uraian_singkat_pekerjaan=%(uraian_singkat_pekerjaan)s, tanggal_pembuatan=%(tanggal_pembuatan)s, tahap_tender_saat_ini=%(tahap_tender_saat_ini)s, klpd=%(klpd)s, satuan_kerja=%(satuan_kerja)s, jenis_pengadaan=%(jenis_pengadaan)s, metode_pengadaan=%(metode_pengadaan)s, tahun_anggaran=%(tahun_anggaran)s, nilai_pagu_paket=%(nilai_pagu_paket)s, nilai_hps_paket=%(nilai_hps_paket)s, lokasi_pekerjaan=%(lokasi_pekerjaan)s, kualifikasi_usaha=%(kualifikasi_usaha)s, bobot_teknis=%(bobot_teknis)s, bobot_biaya=%(bobot_biaya)s, syarat_kualifikasi=%(syarat_kualifikasi)s, peserta_tender=%(peserta_tender)s WHERE kode_tender=%(kode_tender)s")
                    
            self.cursor.execute(sql, data_detail)
            self.koneksi.commit()
        except Exception as e:
            print("Error: ", e)
            self.koneksi.rollback()
    
    def closed(self, reason):
        self.cursor.close()
        self.koneksi.close()