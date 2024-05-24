import mysql.connector
from pyproc import Lpse

koneksi = mysql.connector.connect(host="localhost",user="tenderplus",password="accJp8Dm3z6jPFfc",database="tenderplus")
cursor = koneksi.cursor()
 
#scrap detail paket
cursor.execute("SELECT lpse.id_lpse,url,kode_tender FROM paket,lpse WHERE paket.id_lpse=lpse.id_lpse AND nama_tender IS NULL AND id_paket BETWEEN 40000 AND 50000 ORDER BY RAND()")
result = cursor.fetchall()

for paket in result:
    lpse = Lpse(paket[1])
    detil = lpse.detil_paket_tender(id_paket=paket[2])
    detil.get_all_detil()
    tender = detil.todict()
    pengumuman = {}
    jadwal = {}
    peserta = {}
    evaluasi = {}
    pemenang = {}
    kode_tender = tender['id_paket']
    
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
    
    #scrap pengumuman
    tgl_pembuatan = tender['pengumuman']['tanggal_pembuatan'].split()
    tgl_pembuatan = tgl_pembuatan[2]+'-'+bulan[tgl_pembuatan[1]]+'-'+tgl_pembuatan[0]
    
    tahap_tender = tender['pengumuman']['tahap_tender_saat_ini'].replace(' [...]','')
    sql = "SELECT id_tahap FROM tahap WHERE nama_tahap='"+tahap_tender+"'"
    cursor.execute(sql)
    result = cursor.fetchone()
    id_tahap = str(result[0])
    
    jenis_pengadaan = tender['pengumuman']['jenis_pengadaan']
    if jenis_pengadaan == 'Pengadaan Barang': jenis = '1'
    elif jenis_pengadaan == 'Pekerjaan Konstruksi': jenis = '2'
    elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Non Konstruksi': jenis = '3'
    elif jenis_pengadaan == 'Jasa Konsultansi Badan Usaha Konstruksi': jenis = '4'
    elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Non Konstruksi': jenis = '5'
    elif jenis_pengadaan == 'Jasa Konsultansi Perorangan Konstruksi': jenis = '6'
    elif jenis_pengadaan == 'Jasa Lainnya': jenis = '7'
    elif jenis_pengadaan == 'Pekerjaan Konstruksi Terintegrasi': jenis = '8'
    
    tahun_anggaran = tender['pengumuman']['tahun_anggaran'].split()
    tahun_anggaran = tahun_anggaran[0]+' '+tahun_anggaran[1]
    
    status_tender = ', '.join(tender['pengumuman']['label_paket'])
    
    # if 'uraian_singkat_pekerjaan' in tender['pengumuman']: uraian_singkat_pekerjaan = tender['pengumuman']['uraian_singkat_pekerjaan']
    # else:
    uraian_singkat_pekerjaan = ''
    
    if 'kualifikasi_usaha' in tender['pengumuman']: kualifikasi_usaha = tender['pengumuman']['kualifikasi_usaha']
    else: kualifikasi_usaha = ''
    
    if 'bobot_teknis' in tender['pengumuman']: bobot_teknis = tender['pengumuman']['bobot_teknis']
    else: bobot_teknis = 0
    
    if 'bobot_biaya' in tender['pengumuman']: bobot_biaya = tender['pengumuman']['bobot_biaya']
    else: bobot_biaya = 0
    
    pengumuman['id_lpse'] = paket[0]
    pengumuman['kode_tender'] = kode_tender
    pengumuman['nama_tender'] = tender['pengumuman']['nama_tender']
    pengumuman['status_tender'] = status_tender
    pengumuman['uraian_singkat_pekerjaan'] = uraian_singkat_pekerjaan
    pengumuman['tanggal_pembuatan'] = tgl_pembuatan
    pengumuman['tahap_tender_saat_ini'] = id_tahap
    pengumuman['klpd'] = tender['pengumuman']['k/l/pd']
    pengumuman['satuan_kerja'] = tender['pengumuman']['satuan_kerja']
    pengumuman['jenis_pengadaan'] = jenis
    pengumuman['metode_pengadaan'] = tender['pengumuman']['metode_pengadaan']
    pengumuman['tahun_anggaran'] = tahun_anggaran
    pengumuman['nilai_pagu_paket'] = tender['pengumuman']['nilai_pagu_paket']
    pengumuman['nilai_hps_paket'] = tender['pengumuman']['nilai_hps_paket']
    pengumuman['lokasi_pekerjaan'] = tender['pengumuman']['lokasi_pekerjaan'][0]
    pengumuman['kualifikasi_usaha'] = kualifikasi_usaha
    pengumuman['bobot_teknis'] = bobot_teknis
    pengumuman['bobot_biaya'] = bobot_teknis
    pengumuman['syarat_kualifikasi'] = ''
    pengumuman['peserta_tender'] = tender['pengumuman']['peserta_tender']
    
    #simpan pengumuman
    try:
        sql = "SELECT kode_tender FROM paket WHERE kode_tender='"+kode_tender+"'"
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
    
    #scrap jadwal
    for tahap in tender['jadwal']:
        sql = "SELECT id_tahap FROM tahap WHERE nama_tahap='"+tahap['tahap']+"'"
        cursor.execute(sql)
        result = cursor.fetchone()
        id_tahap = str(result[0])
        
        mulai = tahap['mulai'].split()
        mulai = mulai[2]+'-'+bulan[mulai[1]]+'-'+mulai[0]+' '+mulai[3]
        
        sampai = tahap['sampai'].split()
        sampai = sampai[2]+'-'+bulan[sampai[1]]+'-'+sampai[0]+' '+sampai[3]
        
        if tahap['perubahan'] == 'Tidak Ada':
            perubahan = ''
        else:
            perubahan = tahap['perubahan'].split()[0]
        
        jadwal['kode_tender'] = kode_tender
        jadwal['id_tahap'] = id_tahap
        jadwal['mulai'] = mulai
        jadwal['sampai'] = sampai
        jadwal['perubahan'] = perubahan
        
        #simpan jadwal
        try:
            sql = "SELECT id_jadwal FROM jadwal WHERE kode_tender='"+kode_tender+"' AND id_tahap="+id_tahap
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
    
    #scrap peserta & peserta tender
    if 'npwp' in tender['peserta'][0]:
        for penyedia in tender['peserta']:
            if 'harga_penawaran' in penyedia:
                harga_penawaran = penyedia['harga_penawaran'].replace('Rp. ','').replace('.','').replace(',','.')
                harga_terkoreksi = penyedia['harga_terkoreksi'].replace('Rp. ','').replace('.','').replace(',','.')
            else:
                harga_penawaran = harga_terkoreksi = 0
           
            peserta['kode_tender'] = kode_tender
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
                sql = "SELECT id_peserta_tender FROM peserta_tender WHERE kode_tender='"+kode_tender+"' AND npwp='"+penyedia['npwp']+"'"
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
        
    #scrap evaluasi
    if tender['hasil'] is not None:
        for hasil in tender['hasil']:
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
    
            evaluasi['kode_tender'] = kode_tender
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
            
            #simpan evaluasi
            try:
                sql = "SELECT id_evaluasi FROM hasil_evaluasi WHERE kode_tender='"+kode_tender+"' AND npwp='"+hasil['npwp']+"'"
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
              
    #scrap pemenang
    if tender['pemenang'] is not None:
        pemenang['kode_tender'] = kode_tender
        pemenang['npwp'] = tender['pemenang'][0]['npwp']
        pemenang['nama_pemenang'] = tender['pemenang'][0]['nama_pemenang']
        pemenang['alamat'] = tender['pemenang'][0]['alamat']
        pemenang['harga_negosiasi'] = tender['pemenang'][0]['harga_negosiasi']
        
        if tender['pemenang_berkontrak']:
            pemenang['harga_kontrak'] = tender['pemenang_berkontrak'][0]['harga_kontrak']
            pemenang['nilai_pdn'] = tender['pemenang_berkontrak'][0]['nilai_pdn']
            pemenang['nilai_umk'] = tender['pemenang_berkontrak'][0]['nilai_umk']
            
            if 'status_kontrak' in tender['pemenang_berkontrak']: status = tender['pemenang_berkontrak'][0]['status_kontrak']
            else: status = ''
            pemenang['status_kontrak'] = status
        else:
            pemenang['harga_kontrak'] = pemenang['nilai_pdn'] = pemenang['nilai_umk'] = 0
            pemenang['status_kontrak'] = ''

        #simpan pemenang
        try:
            sql = "SELECT id_pemenang FROM pemenang WHERE kode_tender='"+kode_tender+"'"
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
            sql = ("UPDATE peserta SET alamat=%(alamat)s WHERE npwp='"+tender['pemenang'][0]['npwp']+"'")
            cursor.execute(sql, pemenang)
            koneksi.commit()
        except Exception as e:
            print("Error: ", e)
            koneksi.rollback()

cursor.close()
koneksi.close()