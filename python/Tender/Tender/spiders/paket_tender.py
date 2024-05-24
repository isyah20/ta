#!/www/wwwroot/tenderplus.id/python/28b662d883b6d76fd96e4ddc5e9ba780_venv/bin/python3
import scrapy
import mysql.connector
from scrapy_splash import SplashRequest

class PaketTender(scrapy.Spider):
    name = 'paket_tender'
    start_urls = ['https://sikap.lkpp.go.id/pelaku-usaha/cari']#['https://lpse.jogjaprov.go.id/eproc4/lelang']
    
    def __init__(self):
        self.koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
        self.cursor = self.koneksi.cursor()
        
    def start_requests(self):
        '''self.cursor.execute("SELECT CONCAT(url,'/lelang','#',id_lpse) AS url FROM lpse WHERE id_lpse=13")
        result = self.cursor.fetchall()
        
        urls = []
        for x in result:
            urls.append(x[0])

        for x in urls:
            url = x.split('#')[0]
            id_lpse = x.split('#')[1]
        for url in self.start_urls:
            yield SplashRequest(
                url,
                self.parse,
                args={
                    'wait': 1,
                    'images': 0,
                    'timeout': 30,
                    'lua_source': """
                        function main(splash, args)
                            assert(splash:go(args.url))
                            assert(splash:wait(args.wait))
                            local element = splash:select('#tbllelang_next > a::attr(href)')
                            local count = 0
                            while element and count < 2 do
                                assert(element:mouse_click())
                                assert(splash:wait(args.wait))
                                element = splash:select('#tbllelang_next > a::attr(href)')
                                count = count + 1
                            end
                            return {
                                html = splash:html(),
                                url = splash:url(),
                            }
                        end
                    """
                }
            )'''
        
        for url in self.start_urls:
            '''yield SplashRequest(
                url,
                self.parse,
                args={
                    'wait': 1,
                    'images': 0,
                    'timeout': 30,
                }
            )'''

            '''args={
                    'wait': 1,
                    'images': 0,
                    'timeout': 30,
                    'lua_source': """
                        function main(splash, args)
                            assert(splash:go(args.url))
                            assert(splash:wait(args.wait))
                            local element = splash:select('#tblLelang_next')
                            while element do
                                assert(element:mouse_click())
                                assert(splash:wait(args.wait))
                                element = splash:select('#tblLelang_next')
                            end
                            return {
                                html = splash:html(),
                                url = splash:url(),
                            }
                        end
                    """
                }'''
            
            yield SplashRequest(url, callback=self.parse, args={'wait': 0.5})
            
    def parse(self, response):
        print('a')
        #id_lpse = response.meta.get('id_lpse')
        #url_lpse = response.meta.get('url_lpse')
        '''rows = response.css('#tbllelang > tbody > tr')
        
        for row in rows:
            kode_tender = row.css('td:nth-child(1)::text').get()
            nama_tender = row.css('td:nth-child(2) > p:nth-child(1) > a::text').get()
            status_tender = row.css('td:nth-child(2) > p:nth-child(1) > a > .badge::text').getall()
            tahap_tender_saat_ini = row.css('td:nth-child(4) > a::text').get().replace(' [...]','')
            klpd = row.css('td:nth-child(3)::text').get()
            hps = row.css('td:nth-child(5)::text').get()
            
            metode = row.css('td:nth-child(2) > p:nth-child(2)::text').get().split(' - ')
            tahun_anggaran = metode[1].replace('TA ','')
            metode_pengadaan = metode[2]+' - '+metode[3]
            jenis_pengadaan = metode[0]
            if jenis_pengadaan == 'Pengadaan Barang': jenis = '1'
            elif jenis_pengadaan == 'Pekerjaan Konstruksi': jenis = '2'
            elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Non Konstruksi': jenis = '3'
            elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Konstruksi': jenis = '4'
            elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Non Konstruksi': jenis = '5'
            elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Konstruksi': jenis = '6'
            elif jenis_pengadaan == 'Jasa Lainnya': jenis = '7'
            elif jenis_pengadaan == 'Pekerjaan Konstruksi Terintegrasi': jenis = '8'
            
            data = {
                'kode_tender': kode_tender,
                'nama_tender': nama_tender,
                'status': status_tender,
                'tahap_tender_saat_ini': tahap_tender_saat_ini,
                'klpd': klpd,
                'jenis_pengadaan': jenis,
                'metode_pengadaan': metode_pengadaan,
                'tahun_anggaran': tahun_anggaran,
                'hps': hps
            }
        
            print(data)
        
        page = response.meta.get('page', 1)
        next_page = response.css('#tbllelang_next a::attr(href)').get()
        print('next: '+next_page)
        if next_page is not None and page < 3:
            page += 1
            yield SplashRequest(
                response.urljoin(next_page),
                self.parse,
                args={
                    'wait': 1,
                    'images': 0,
                    'timeout': 30,
                },
                meta={'page': page}
            )'''
        
        '''next_page = response.css('#tbllelang_next a::attr(href)').get()
        page = response.meta.get('page', 1)
        if next_page is not None and page < 3:
            page += 1
            yield SplashRequest(
                response.urljoin(next_page),
                self.parse,
                args={
                    'wait': 1,
                    'images': 0,
                    'timeout': 30,
                },
                meta={'page': page}
            )'''
    
    def closed(self, reason):
        self.cursor.close()
        self.koneksi.close()