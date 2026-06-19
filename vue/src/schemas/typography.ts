export default {
    size: [
        {
            type: 'number',
            key: 'xl6',
            id: 'tm_typography_font_size_6xl',
            label: 'Hero title',
            min: 0,
            max: 100,
        },

        {
            type: 'number',
            key: 'xl5',
            id: 'tm_typography_font_size_5xl',
            label: 'Big title',

            props: {
                min: 0,
                max: 100,
            }
        },

        {
            type: 'number',
            key: 'xl4',
            id: 'tm_typography_font_size_4xl',
            label: 'Main title',

            props: {
                min: 0,
                max: 100,
            }
        },

        {
            type: 'number',
            key: 'xl3',
            id: 'tm_typography_font_size_3xl',
            label: 'Section title',

            props: {
                min: 0,
                max: 100,
            }
        },

        {
            type: 'number',
            key: 'xl',
            id: 'tm_typography_font_size_xl',
            label: 'Subtitle',

            props: {
                min: 0,
                max: 100,
            }
        },

        {
            type: 'number',
            key: 'base',
            id: 'tm_typography_font_size_base',
            label: 'Main text',

            props: {
                min: 0,
                max: 100,
            }
        },

        {
            type: 'number',
            key: 'sm',
            id: 'tm_typography_font_size_sm',
            label: 'Small text',

            props: {
                min: 0,
                max: 100,
            }
        },

        {
            type: 'number',
            key: 'xs',
            id: 'tm_typography_font_size_xs',
            label: 'Caption',

            props: {
                min: 0,
                max: 100,
            }
        },
    ],

    fonts: [

        {
            key: 'primary',
            type: 'text',
            label: 'فونت اصلی'
        },

        {
            key: 'secondary',
            type: 'text',
            label: 'فونت دوم'
        }
    ]
}