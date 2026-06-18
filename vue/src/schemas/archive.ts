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
        min: 2,
        max: 24,
        step: 2
    }
]