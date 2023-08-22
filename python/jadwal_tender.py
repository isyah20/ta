import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()

cursor.execute("SELECT url,kode_tender FROM paket,lpse WHERE paket.id_lpse=lpse.id_lpse")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[0])
    detil = lpse.detil_paket_tender(id_paket=paket[1])
    tender = detil.get_jadwal()
    jadwal = {}
    
    for tahap in tender:
        sql = "SELECT id_tahap FROM tahap WHERE nama_tahap='"+tahap['tahap']+"'"
        cursor.execute(sql)
        result = cursor.fetchone()
        id_tahap = str(result[0])
        
        mulai = tahap['mulai'].split()
        if mulai[1] == 'Januari': bln = '01'
        elif mulai[1] == 'Februari': bln = '02'
        elif mulai[1] == 'Maret': bln = '03'
        elif mulai[1] == 'April': bln = '04'
        elif mulai[1] == 'Mei': bln = '05'
        elif mulai[1] == 'Juni': bln = '06'
        elif mulai[1] == 'Juli': bln = '07'
        elif mulai[1] == 'Agustus': bln = '08'
        elif mulai[1] == 'September': bln = '09'
        elif mulai[1] == 'Oktober': bln = '10'
        elif mulai[1] == 'November': bln = '11'
        elif mulai[1] == 'Desember': bln = '12'
        mulai = mulai[2]+'-'+bln+'-'+mulai[0]+' '+mulai[3]
        
        sampai = tahap['sampai'].split()
        if sampai[1] == 'Januari': bln = '01'
        elif sampai[1] == 'Februari': bln = '02'
        elif sampai[1] == 'Maret': bln = '03'
        elif sampai[1] == 'April': bln = '04'
        elif sampai[1] == 'Mei': bln = '05'
        elif sampai[1] == 'Juni': bln = '06'
        elif sampai[1] == 'Juli': bln = '07'
        elif sampai[1] == 'Agustus': bln = '08'
        elif sampai[1] == 'September': bln = '09'
        elif sampai[1] == 'Oktober': bln = '10'
        elif sampai[1] == 'November': bln = '11'
        elif sampai[1] == 'Desember': bln = '12'
        sampai = sampai[2]+'-'+bln+'-'+sampai[0]+' '+sampai[3]
        
        if tahap['perubahan'] == 'Tidak Ada':
            perubahan = ''
        else:
            perubahan = tahap['perubahan'].split()[0]
        
        jadwal['kode_tender'] = paket[1]
        jadwal['id_tahap'] = id_tahap
        jadwal['mulai'] = mulai
        jadwal['sampai'] = sampai
        jadwal['perubahan'] = perubahan
        
        try:
            sql = "SELECT id_jadwal FROM jadwal WHERE kode_tender='"+paket[1]+"' AND id_tahap="+id_tahap
            cursor.execute(sql)
            result = cursor.fetchone()
            
            if result is None:
                sql = ("INSERT INTO jadwal VALUES (NULL, %(kode_tender)s, %(id_tahap)s, %(mulai)s, %(sampai)s, %(perubahan)s)")
            else:
                id_jadwal = str(result[0])
                sql = ("UPDATE jadwal SET tgl_mulai=%(mulai)s, tgl_akhir=%(sampai)s, perubahan=%(perubahan)s WHERE id_jadwal="+id_jadwal)
                    
            cursor.execute(sql, jadwal)
            koneksi.commit()
        except Exception as e:
            print("Error: ", e)
            koneksi.rollback()

cursor.close()
koneksi.close()