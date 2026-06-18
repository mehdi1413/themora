import type { MenuItem } from '@/types/menu'

import GeneralPage from '@/pages/GeneralPage.vue'
import ArchivePage from '@/pages/ArchivePage.vue'

import {
    RiSettings3Line,
    RiArchiveLine,
    RiInstanceFill,
    RiCheckboxBlankCircleFill,

} from '@remixicon/vue'

export const createMenus = ():MenuItem[] => [

    {
        title:'عمومی',
        icon:RiSettings3Line,
        page:GeneralPage,
    },

    {
        title:'آرشیو',
        icon:RiArchiveLine,
        page:ArchivePage,
    },

    {
        title:'محصولات',
        icon:RiInstanceFill,
        children:[
            {
                title:'تنظیمات محصول',
                icon:RiCheckboxBlankCircleFill,
                children:[
                    {
                        title:'ظاهر محصول',
                        icon:RiCheckboxBlankCircleFill,
                        link:'#'
                    },
                    {
                        title:'تب ها',
                        icon:RiCheckboxBlankCircleFill,
                        link:'#'
                    }

                ]

            },
            {
                title:'انبار',
                icon:RiCheckboxBlankCircleFill,
                link:'#'
            }
        ]

    }

]


export const createMenusOld = (settings:any):MenuItem[] => [

    {
        title:'عمومی',
        icon:RiSettings3Line,
        page:GeneralPage,
        settings:settings.general
    },

    {
        title:'آرشیو',
        icon:RiArchiveLine,
        page:ArchivePage,
        settings:settings.archive
    },

    {
        title:'محصولات',
        icon:RiInstanceFill,
        children:[
            {
                title:'تنظیمات محصول',
                icon:RiCheckboxBlankCircleFill,
                children:[
                    {
                        title:'ظاهر محصول',
                        icon:RiCheckboxBlankCircleFill,
                        link:'#'
                    },
                    {
                        title:'تب ها',
                        icon:RiCheckboxBlankCircleFill,
                        link:'#'
                    }

                ]

            },
            {
                title:'انبار',
                icon:RiCheckboxBlankCircleFill,
                link:'#'
            }
        ]

    }

]