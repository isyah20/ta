import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

cursor.execute("SELECT url,pemenang.kode_tender,id_pemenang FROM pemenang,paket,lpse WHERE paket.kode_tender=pemenang.kode_tender AND paket.id_lpse=lpse.id_lpse AND pemenang.kode_tender=33144011")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[0])
    detil = lpse.detil_paket_tender(id_paket=paket[1])
    tender = detil.get_pemenang()
    pemenang = {}
    
    print(tender)

    '''if tender: #  is not None
        pemenang['npwp'] = tender[0]['npwp']
        pemenang['nama_pemenang'] = tender[0]['nama_pemenang']
        pemenang['alamat'] = tender[0]['alamat']
        alamat = tender[0]['alamat'].split()
        pemenang['kabupaten'] = alamat[len(alamat-1)]
        pemenang['provinsi'] = alamat[len(alamat-2)]
        
        print(pemenang)'''

        #simpan pemenang
        '''try:
            id_pemenang = str(paket[2])
            sql = ("UPDATE pemenang SET npwp=%(npwp)s, nama_pemenang=%(nama_pemenang)s, alamat=%(alamat)s, kabupaten=%(kabupaten)s, provinsi=%(provinsi)s WHERE id_pemenang="+id_pemenang)
                        
            cursor.execute(sql, pemenang)
            koneksi.commit()
        except Exception as e:
            print("Error: ", e)
            koneksi.rollback()'''

cursor.close()
koneksi.close()




'''import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

cursor.execute("SELECT url,kode_tender FROM paket,lpse WHERE paket.id_lpse=lpse.id_lpse")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[0])
    detil = lpse.detil_paket_tender(id_paket=paket[1])
    tender = detil.get_pemenang()
    pemenang = {}
    
    if tender: #  is not None
        pemenang['kode_tender'] = paket[1]
        pemenang['npwp'] = tender[0]['npwp']
        pemenang['nama_pemenang'] = tender[0]['nama_pemenang']
        pemenang['alamat'] = tender[0]['alamat']
        pemenang['harga_negosiasi'] = tender[0]['harga_negosiasi']
        
        kontrak = detil.get_pemenang_berkontrak()
        if kontrak: #  is not None
            pemenang['harga_kontrak'] = kontrak[0]['harga_kontrak']
            pemenang['nilai_pdn'] = kontrak[0]['nilai_pdn']
            pemenang['nilai_umk'] = kontrak[0]['nilai_umk']
            
            if 'status_kontrak' in kontrak: status = kontrak[0]['status_kontrak']
            else: status = ''
            pemenang['status_kontrak'] = status
        else:
            pemenang['harga_kontrak'] = pemenang['nilai_pdn'] = pemenang['nilai_umk'] = 0
            pemenang['status_kontrak'] = ''
        
        try:
            sql = "SELECT id_pemenang FROM pemenang WHERE kode_tender='"+paket[1]+"'"
            cursor.execute(sql)
            result = cursor.fetchone()
                
            if result is None:
                sql = ("INSERT INTO pemenang VALUES (NULL, %(kode_tender)s, %(npwp)s, %(harga_negosiasi)s, %(harga_kontrak)s, %(nilai_pdn)s, %(nilai_umk)s, %(status_kontrak)s)")
            else:
                id_pemenang = str(result[0])
                sql = ("UPDATE pemenang SET kode_tender=%(kode_tender)s, npwp=%(npwp)s, harga_negosiasi=%(harga_negosiasi)s, harga_kontrak=%(harga_kontrak)s, nilai_pdn=%(nilai_pdn)s, nilai_umk=%(nilai_umk)s, status_kontrak=%(status_kontrak)s WHERE id_pemenang="+id_pemenang)
                        
            cursor.execute(sql, pemenang)
            koneksi.commit()
        except Exception as e:
            print("Error: ", e)
            koneksi.rollback()
        
        #update peserta
        try:
            sql = ("UPDATE peserta SET alamat=%(alamat)s WHERE npwp='"+tender[0]['npwp']+"'")
            cursor.execute(sql, pemenang)
            koneksi.commit()
        except Exception as e:
            print("Error: ", e)
            koneksi.rollback()

cursor.close()
koneksi.close()'''