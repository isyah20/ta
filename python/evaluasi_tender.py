import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

cursor.execute("SELECT url,kode_tender FROM paket,lpse WHERE paket.id_lpse=lpse.id_lpse")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[0])
    detil = lpse.detil_paket_tender(id_paket=paket[1])
    tender = detil.get_hasil_evaluasi()
    evaluasi = {}
    
    if tender is not None:
        for hasil in tender:
            if 'k' in hasil: kualifikasi = hasil['k']
            else: kualifikasi = ''
            
            if 'sk' in hasil: skor_kualifikasi = hasil['sk'].replace(',','.')
            else: skor_kualifikasi = 0
            if skor_kualifikasi == '': skor_kualifikasi = 0
            
            if 'b' in hasil: pembuktian = hasil['b']
            else: pembuktian = ''
            
            if 'sb' in hasil: skor_pembuktian = hasil['sb'].replace(',','.')
            else: skor_pembuktian = 0
            if skor_pembuktian == '': skor_pembuktian = 0
            
            if 'a' in hasil: administrasi = hasil['a']
            else: administrasi = ''
            
            if 't' in hasil: teknis = hasil['t']
            else: teknis = ''
            
            if 'st' in hasil: skor_teknis = hasil['st'].replace(',','.')
            else: skor_teknis = 0
            if skor_teknis == '': skor_teknis = 0
            
            if 'h' in hasil: harga = hasil['h']
            else: harga = ''
            
            if 'sh' in hasil: skor_harga = hasil['sh'].replace(',','.')
            else: skor_harga = 0
            if skor_harga == '': skor_harga = 0
            
            if 'sa' in hasil: skor_akhir = hasil['sa'].replace(',','.')
            else: skor_akhir = 0
            if skor_akhir == '': skor_akhir = 0
            
            if 'p' in hasil: menang = hasil['p']
            else: menang = ''
            
            if 'pk' in hasil: menang_kontrak = hasil['pk']
            else: menang_kontrak = ''
            
            if 'alasan' in hasil: alasan = hasil['alasan']
            else: alasan = ''
    
            evaluasi['kode_tender'] = paket[1]
            evaluasi['npwp'] = hasil['npwp']
            evaluasi['kualifikasi'] = kualifikasi
            evaluasi['skor_kualifikasi'] = skor_kualifikasi
            evaluasi['pembuktian'] = pembuktian
            evaluasi['skor_pembuktian'] = skor_pembuktian
            evaluasi['administrasi'] = administrasi
            evaluasi['teknis'] = teknis
            evaluasi['skor_teknis'] = skor_teknis
            evaluasi['harga'] = harga
            evaluasi['skor_harga'] = skor_harga
            evaluasi['skor_akhir'] = skor_akhir
            evaluasi['pemenang'] = menang
            evaluasi['pemenang_kontrak'] = menang_kontrak
            evaluasi['alasan'] = alasan
            
            try:
                sql = "SELECT id_evaluasi FROM hasil_evaluasi WHERE kode_tender='"+paket[1]+"' AND npwp='"+hasil['npwp']+"'"
                cursor.execute(sql)
                result = cursor.fetchone()
                
                if result is None:
                    sql = ("INSERT INTO hasil_evaluasi VALUES (NULL, %(kode_tender)s, %(npwp)s, %(kualifikasi)s, %(skor_kualifikasi)s, %(pembuktian)s, %(skor_pembuktian)s, %(administrasi)s, %(teknis)s, %(skor_teknis)s, %(harga)s, %(skor_harga)s, %(skor_akhir)s, %(pemenang)s, %(pemenang_kontrak)s, %(alasan)s)")
                else:
                    id_evaluasi = str(result[0])
                    sql = ("UPDATE hasil_evaluasi SET kode_tender=%(kode_tender)s, npwp=%(npwp)s, kualifikasi=%(kualifikasi)s, skor_kualifikasi=%(skor_kualifikasi)s, pembuktian=%(pembuktian)s, skor_pembuktian=%(skor_pembuktian)s, administrasi=%(administrasi)s, teknis=%(teknis)s, skor_teknis=%(skor_teknis)s, harga=%(harga)s, skor_harga=%(skor_harga)s, skor_akhir=%(skor_akhir)s, pemenang=%(pemenang)s, pemenang_kontrak=%(pemenang_kontrak)s, alasan=%(alasan)s WHERE id_evaluasi="+id_evaluasi)
                        
                cursor.execute(sql, evaluasi)
                koneksi.commit()
            except Exception as e:
                print("Error: ", e)
                koneksi.rollback()

cursor.close()
koneksi.close()