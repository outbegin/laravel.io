import algoliasearch from 'algoliasearch';

const client = algoliasearch(process.env.MIX_ALGOLIA_APP_ID, process.env.MIX_ALGOLIA_SECRET)
const index = client.initIndex(process.env.MIX_SCOUT_INDEX)

window.search = (event) => {
    if(!event.target.value) {
        return;
    }

    return index.search(event.target.value, {
        hitsPerPage: 5,
    }).then(response => response)
        .then(({ hits }) => hits)
}
