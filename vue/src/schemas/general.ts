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

        props:{
            options:[
                {
                    label:'نزولی',
                    value:'ASC'
                },
                {
                    label:'صعودی',
                    value:'DESC'
                }
            ]
        },
    },

    {
        type: 'toggle',
        key: 'showTitle',
        id: 'tm_show_general_title',
        label: 'Show Title'
    },

    {
        type:'media',
        key:'logo',
        id:'tm_logo',
        label:'لوگو',
        fileType:'image'
    }

]