export const generatePagination = ( collectionObject, perPage) => {
    if (collectionObject.length <= 0) {
        return { 
            per: perPage,
            last: 0,
            pages: [],
            first: 0,
            current: 0,
            previous: 0,
            next: 0
        }
    }

    let firstPage = setFirstPage(collectionObject);
    return {
        per: perPage,
        last: getPaginationPagesLength(collectionObject, perPage),
        pages: generatePagesContent(collectionObject, perPage),
        first: firstPage,
        current: firstPage,
        previous: firstPage - 1,
        next: firstPage + 1,
    }
}

function setFirstPage(collectionObject) {
    if (collectionObject.length <= 0) return 0;
    return 1;
}

function getPaginationPagesLength(collectionObject, perPage) {
    if (collectionObject.length <= 0 || perPage === 0) return 0;
    return collectionObject.length % perPage === 0 ? 
        collectionObject.length / perPage  : Math.floor( collectionObject.length / perPage ) + 1;
}

function generatePagesContent(collectionObject, perPage) {
    let start = 0, end = perPage, pageContent = [];

    let lastPage = getPaginationPagesLength(collectionObject, perPage);

    if (collectionObject.length <= perPage) {
        pageContent.push(collectionObject);
    } else {
        for ( let page = 1; page <= lastPage; page++ ) {
            if ( page > 1 && page < lastPage ) {
                start = end;
                end += perPage;
            } 

            if (page === lastPage) {
                start = end;
                end = collectionObject.length;
            }

            let tempPageContent = [];

            for ( ; start < end; start++ ) {
                tempPageContent.push( collectionObject[start] );
            }

            pageContent.push(tempPageContent);
        }
    }
    return pageContent;
}