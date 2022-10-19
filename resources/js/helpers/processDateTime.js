export const processDate = function(date_info) {
    return new Date(date_info).toLocaleString('en', { day: 'numeric', month: 'long', year: 'numeric' })
}

export const processTime = function(date_info) {
    return new Date(date_info).toLocaleTimeString('en', { hour: 'numeric', minute: 'numeric', timeZoneName: 'short', timeZone: 'Europe/Dublin', hour12: false})
}