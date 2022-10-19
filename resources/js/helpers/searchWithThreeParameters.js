export const searchWithThreeParameters = (searchDataset, label1, param1, label2, param2, label3, param3) => {
    const generatedResult = []

    searchDataset.map( data => {
        if (
            data[label1].toLowerCase().search(param1.toLowerCase()) >= 0 &&
            data[label2].toLowerCase().search(param2.toLowerCase()) >= 0 &&
            data[label3].toLowerCase().search(param3.toLowerCase()) >= 0
        ) {
            generatedResult.push(data)
        }
    })

    return generatedResult
}