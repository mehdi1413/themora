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
    },

    {
        type:'multiselect',
        key:'items',
        id:'tm_profile_items',
        label:'آیتم های پروفایل',

        props:{
            searchable:true,

            options:[
                {
                    label:'داشبورد',
                    value:'dashboard'
                },
                {
                    label:'سفارشات',
                    value:'orders'
                },
                {
                    label:'دانلودها',
                    value:'downloads'
                },
                {
                    label:'اطلاعات حساب',
                    value:'edit-account'
                },
                {
                    label:'خروج',
                    value:'customer-logout'
                }
            ]
        }
    },

    {
        type:'icon',
        key:'testIcon',
        id:'test_icon',
        label:'تست آیکن'
    },
]