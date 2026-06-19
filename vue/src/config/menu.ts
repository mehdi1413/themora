import type { MenuItem } from '@/types/menu'

import GeneralPage from '@/pages/GeneralPage.vue'
import ArchivePage from '@/pages/ArchivePage.vue'
import ColorsPage from "@/pages/ColorsPage.vue";
import TypographyPage from "@/pages/TypographyPage.vue"

import {
    RiSettings4Fill,
    RiArchiveFill,
    RiInstanceFill,
    RiCheckboxBlankCircleFill,
    RiBrushAiFill,
    RiFontSize2
} from '@remixicon/vue'

export const createMenus = ():MenuItem[] => [

    {
        title:'عمومی',
        icon:RiSettings4Fill,
        page:GeneralPage,
    },
    {
        title:'رنگ بندی',
        icon:RiBrushAiFill,
        children:[
            {
                title:'رنگ های اصلی',
                icon:RiCheckboxBlankCircleFill,
                page:ColorsPage,
                section:'primary'
            },
            {
                title:'رنگ های فرعی',
                icon:RiCheckboxBlankCircleFill,
                page:ColorsPage,
                section:'secondary'
            },
        ]
    },


    {
        title:'تایپوگرافی',
        icon:RiFontSize2,
        children:[
            {
                title:'اندازه فونت‌ها',
                icon:RiCheckboxBlankCircleFill,
                page:TypographyPage,
                section:'size'
            },
            {
                title:'فونت‌های سفارشی',
                icon:RiCheckboxBlankCircleFill,
                page:TypographyPage,
                section:'fonts'
            },
        ]
    },

    {
        title:'آرشیو',
        icon:RiArchiveFill,
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