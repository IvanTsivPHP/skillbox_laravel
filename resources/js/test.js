Echo
    .channel('test')
    .listen('TestEvent', (e) => {
        alert(e.var)
    })
