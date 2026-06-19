import type { Component } from 'vue'

export interface MenuItem {
    title:string
    icon?:Component
    link?:string
    page?:Component
    section?:string
    settings?:any
    children?:MenuItem[]
}