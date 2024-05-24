import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

cursor.execute("SELECT url,kode_tender FROM paket,lpse WHERE paket.id_lpse=lpse.id_lpse")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[0])
    detil = lpse.detil_paket_tender(id_paket=paket[1])
    tender = detil.get_peserta()
    peserta = {}
    
    if 'npwp' in tender[0]:
        for penyedia in tender:
            if 'harga_penawaran' in penyedia:
                harga_penawaran = penyedia['harga_penawaran'].replace('Rp. ','').replace('.','').replace(',','.')
                harga_terkoreksi = penyedia['harga_terkoreksi'].replace('Rp. ','').replace('.','').replace(',','.')
            else:
                harga_penawaran = harga_terkoreksi = 0
           
            peserta['kode_tender'] = paket[1]
            peserta['npwp'] = penyedia['npwp']
            peserta['nama_peserta'] = penyedia['nama_peserta']
            peserta['harga_penawaran'] = harga_penawaran
            peserta['harga_terkoreksi'] = harga_terkoreksi
            
            #simpan peserta
            try:
                sql = "SELECT id_peserta FROM peserta WHERE npwp='"+penyedia['npwp']+"'"
                cursor.execute(sql)
                result = cursor.fetchone()
                    
                if result is None:
                    sql = ("INSERT INTO peserta (id_peserta,npwp,nama_peserta) VALUES (NULL, %(npwp)s, %(nama_peserta)s)")
                else:
                    id_peserta = str(result[0])
                    sql = ("UPDATE peserta SET npwp=%(npwp)s, nama_peserta=%(nama_peserta)s WHERE id_peserta="+id_peserta)
                            
                cursor.execute(sql, peserta)
                koneksi.commit()
            except Exception as e:
                print("Error: ", e)
                koneksi.rollback()
                
            #simpan peserta tender
            try:
                sql = "SELECT id_peserta_tender FROM peserta_tender WHERE kode_tender='"+paket[1]+"' AND npwp='"+penyedia['npwp']+"'"
                cursor.execute(sql)
                result = cursor.fetchone()
                    
                if result is None:
                    sql = ("INSERT INTO peserta_tender VALUES (NULL, %(kode_tender)s, %(npwp)s, %(harga_penawaran)s, %(harga_terkoreksi)s)")
                else:
                    id_peserta_tender = str(result[0])
                    sql = ("UPDATE peserta_tender SET kode_tender=%(kode_tender)s, npwp=%(npwp)s, harga_penawaran=%(harga_penawaran)s, harga_terkoreksi=%(harga_terkoreksi)s WHERE id_peserta_tender="+id_peserta_tender)
                            
                cursor.execute(sql, peserta)
                koneksi.commit()
            except Exception as e:
                print("Error: ", e)
                koneksi.rollback()

cursor.close()
koneksi.close()