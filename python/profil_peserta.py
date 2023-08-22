import requests
from io import BytesIO
from PIL import Image
import pytesseract

# Mengambil gambar dari URL
response = requests.get('https://i.stack.imgur.com/WiDpa.jpg')
print(response)
img = Image.open(BytesIO(response.content))
print(img)
# Mengubah mode gambar RGBA menjadi RGB
img = img.convert('RGB')

# Membaca OCR dari gambar menggunakan Pytesseract
text = pytesseract.image_to_string(img)

# Mencetak hasil OCR
print(text)





'''import urllib.request
import cv2
import pytesseract

# Download gambar captcha dan simpan ke disk
url = "https://tenderplus.id/python/quick.jpeg"
urllib.request.urlretrieve(url, "captcha.png")

# Baca gambar captcha dengan OpenCV
img = cv2.imread("captcha.png")
print(img)
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
gray = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]

# Lakukan OCR menggunakan Pytesseract
text = pytesseract.image_to_string(gray, lang='eng')

# Cetak hasil OCR
print(text)'''


'''import cv2
import numpy as np
import pytesseract
import urllib.request

# Download gambar dari URL
url = "https://tenderplus.id/python/quick.jpeg"
urllib.request.urlretrieve(url, "quick.jpeg")

# Baca gambar dan konversi ke grayscale
img = cv2.imread("quick.jpeg")
print(img)
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

# Lakukan segmentasi warna untuk memisahkan latar belakang dan teks pada gambar
mask = cv2.inRange(img, np.array([0, 0, 0]), np.array([200, 200, 200]))

# Terapkan filter untuk menghilangkan noise pada gambar
kernel = np.ones((3, 3), np.uint8)
mask = cv2.erode(mask, kernel, iterations=1)
mask = cv2.dilate(mask, kernel, iterations=2)

# Terapkan mask pada gambar
masked_img = cv2.bitwise_and(img, img, mask=mask)

# Konversi gambar ke grayscale
gray = cv2.cvtColor(masked_img, cv2.COLOR_BGR2GRAY)

# Lakukan thresholding pada gambar
gray = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]

# Terapkan filter untuk menghilangkan noise pada gambar
gray = cv2.medianBlur(gray, 3)

# Gunakan Pytesseract untuk membaca teks dari gambar
text = pytesseract.image_to_string(gray, lang='eng')

# Cetak hasilnya
print(text)'''


'''import pycurl
import cv2
import numpy as np
import pytesseract

# Download gambar dari URL
url = "https://tenderplus.id/python/quick.jpeg"
response = BytesIO()
c = pycurl.Curl()
c.setopt(c.URL, url)
c.setopt(c.WRITEDATA, response)
c.perform()
c.close()
img = np.asarray(bytearray(response.getvalue()), dtype="uint8")
img = cv2.imdecode(img, cv2.IMREAD_COLOR)
print(img)

# Konversi gambar ke grayscale
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

# Lakukan thresholding pada gambar
gray = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]

# Terapkan filter untuk menghilangkan noise pada gambar
gray = cv2.medianBlur(gray, 3)

# Gunakan Pytesseract untuk membaca teks dari gambar
text = pytesseract.image_to_string(gray, lang='eng')

# Cetak hasilnya
print(text)'''


'''import cv2
import urllib.request
import numpy as np
import pytesseract

# Download gambar dari URL
url = "https://tenderplus.id/python/quick.jpeg"
req = urllib.request.urlopen(url)
arr = np.asarray(bytearray(req.read()), dtype=np.uint8)
img = cv2.imdecode(arr, cv2.IMREAD_COLOR)
print(img)

# Konversi gambar ke grayscale
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

# Lakukan thresholding pada gambar
gray = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]

# Terapkan filter untuk menghilangkan noise pada gambar
gray = cv2.medianBlur(gray, 3)

# Gunakan Pytesseract untuk membaca teks dari gambar
text = pytesseract.image_to_string(gray, lang='eng')

# Cetak hasilnya
print(text)'''


'''import cv2
from pytesseract import image_to_string

img = cv2.imread("https://tenderplus.id/python/quick.jpeg")
# https://sikap.lkpp.go.id/pelaku-usaha/application/captcha?id=new%20Date()
print(img)
gry = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
(h, w) = gry.shape[:2]
gry = cv2.resize(gry, (w*2, h*2))
cls = cv2.morphologyEx(gry, cv2.MORPH_CLOSE, None)
thr = cv2.threshold(cls, 0, 255, cv2.THRESH_BINARY | cv2.THRESH_OTSU)[1]
txt = image_to_string(thr)
print(txt)'''


'''import pytesseract
import cv2

# Baca gambar
img = cv2.imread('https://tenderplus.id/python/quick.jpeg')
print(img)
# Konversi gambar menjadi grayscale
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

# Lakukan preprocessing pada gambar
gray = cv2.medianBlur(gray, 3)
gray = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]

# Gunakan Pytesseract untuk membaca teks dari gambar
text = pytesseract.image_to_string(gray, lang='eng')

# Cetak hasilnya
print(text)'''