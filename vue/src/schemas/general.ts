export default [
    {
        type: 'text',
        key: 'title',
        id: 'tm_general_title',
        label: 'General Title'
    },

    {
        type: 'select',
        key: 'selectOne',
        id: 'tm_general_sort',
        label: 'Sort Order',

        options: [
            {
                label: 'نزولی',
                value: 'DESC'
            },

            {
                label: 'صعودی',
                value: 'ASC'
            }
        ]
    },

    {
        type: 'toggle',
        key: 'showTitle',
        id: 'tm_show_general_title',
        label: 'Show Title'
    },
]