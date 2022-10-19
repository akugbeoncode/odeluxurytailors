export const searchWithOneParameter = (searchDataset, label1, param1) => {
    const generatedResult = []

    searchDataset.map( data => {
        if ( data[label1].toLowerCase().search(param1.toLowerCase()) >= 0 ) {
            generatedResult.push(data)
        }
    })

    return generatedResult
}