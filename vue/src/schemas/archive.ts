export default [
    {
        type: 'toggle',
        key: 'removePrefix',
        id: 'tm_archive_prefix',
        label: 'Remove archive prefix'
    },

    {
        type: 'number',
        key: 'perPage',
        id: 'tm_archive_per_page',
        label: 'Posts Per Page',

        props:{
            min:2,
            max:24,
            step:2
        }
    },

    {
        type: 'attachment',
        key: 'test',
        id: 'tm_archive_attachment',
        label: 'Files',

        props:{
            min:2,
            max:24,
            step:2
        }
    }
]