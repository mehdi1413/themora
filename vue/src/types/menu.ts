import type { Component } from 'vue'

export interface MenuItem {
    title:string
    icon?:Component
    link?:string
    page?:Component
    settings?:any
    children?:MenuItem[]
}