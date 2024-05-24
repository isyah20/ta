self.onmessage = (event) => {
  const data = event.data
  if (data.event_name == 'fetch') {
    fetch(data.params.url).then(resp => resp.json())
    .then(resp => {
      postMessage({event_name: 'fetch', data: resp})
    })
  } else if (data.event_name == 'getdata') {
    const payload = data.params.data
    const formData = new FormData()
    formData.append('cariKLPD', payload.klpd)
    formData.append('cariTahun', payload.year)
    fetch(data.params.url, {
      method: 'POST',
      body: formData
    })
    .then(resp => resp.text())
    .then(resp => postMessage({event_name: 'getdata', data: resp}))
  } else {
    postMessage({event_name: 'hello', data: `Hi, ${data}`})
  }
}
