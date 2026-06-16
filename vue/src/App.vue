<script setup lang="ts">
import { ref } from 'vue'

interface MenuItem {
  title: string
  icon: string
  link?: string
  children?: MenuItem[]
}

const sidebarOpen = ref(false)
const collapsed = ref(false)
const isDark = ref(false)

const hoveredMenu = ref<number | null>(null)
const openedMenus = ref<number[]>([])

const menus = ref<MenuItem[]>([
  {
    title: 'عمومی',
    icon: '⚙️',
    link: '#'
  },
  {
    title: 'محصولات',
    icon: '📦',
    children: [
      { title: 'تنظیمات محصول', icon: '•', link: '#' },
      { title: 'انبار', icon: '•', link: '#' }
    ]
  },
  {
    title: 'پرداخت',
    icon: '💳',
    children: [
      { title: 'زرین پال', icon: '•', link: '#' },
      { title: 'ملت', icon: '•', link: '#' }
    ]
  },
  {
    title: 'حمل و نقل',
    icon: '🚚',
    link: '#'
  }
])

const toggleSubmenu = (index: number) => {
  if (collapsed.value) return

  if (openedMenus.value.includes(index)) {
    openedMenus.value = openedMenus.value.filter(i => i !== index)
  } else {
    openedMenus.value.push(index)
  }
}

const toggleSidebar = () => {
  collapsed.value = !collapsed.value
}

const openSidebar = () => {
  sidebarOpen.value = true
}

const closeSidebar = () => {
  sidebarOpen.value = false
}

const toggleTheme = () => {
  isDark.value = !isDark.value
  document.documentElement.classList.toggle('dark', isDark.value)
}
</script>

<template>

  <div class="flex h-screen py-tm-60 gap-4 overflow-hidden">

    <!-- Overlay Mobile -->
    <div
        v-if="sidebarOpen"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"
        @click="closeSidebar"
    />

    <!-- SIDEBAR -->
    <aside
        class="themora-menu bg-tm-primary fixed lg:relative right-0 top-0 z-40 h-full p-tm-5 rounded-tm-12
             transition-all duration-300 shadow"
        :class="[
        collapsed ? 'w-20' : 'w-72',
        sidebarOpen ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'
      ]"
    >

      <!-- Button sidebar accordion-->
      <button
          @click="collapsed = !collapsed"
          class="absolute -left-3 top-3 bg-white rounded-full p-1 shadow hover:scale-110 transition cursor-pointer z-40">
        <svg class="w-5 h-5 transition-transform" :class="collapsed ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
          <path d="M19.1642 12L12.9571 5.79291L11.5429 7.20712L16.3358 12L11.5429 16.7929L12.9571 18.2071L19.1642 12ZM13.5143 12L7.30722 5.79291L5.89301 7.20712L10.6859 12L5.89301 16.7929L7.30722 18.2071L13.5143 12Z"></path>
        </svg>
      </button>

      <!-- HEADER -->
      <div class="flex items-center justify-between p-2 dark:border-gray-700 relative">

        <!-- collapse button -->
        <button @click="toggleSidebar" class="hidden lg:flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
          ☰
        </button>

      </div>

      <!-- MENU -->
      <nav class="space-y-2 relative">
        <div class="fd-setting-brand-wrapper">
          <div class="fd-brand-texts" v-show="!collapsed">
            <p class="brand-text m-0">
              آژانس خلاقیت <span>فرادیـد</span>
            </p>
            <p class="brand-slogan m-0">
              Faradid Creative Agency
            </p>
          </div>

          <img
              src="http://localhost/wp-developer/faradid/wp-content/themes/faradid/assets/admin/images/settings/logo-light.svg"
              width="48"
              height="48"
          />
        </div>
        <ul class="themora-tabs space-y-1">
          <!-- MENU ITEMS -->
          <li
              v-for="(item,index) in menus"
              :key="index"
              class="themora-tab-list relative bg-tm-transparent rounded-tm-6"
              @mouseenter="collapsed && (hoveredMenu = index)"
              @mouseleave="hoveredMenu = null"
          >

            <!-- MAIN ITEM -->
            <div
                class="themora-tab-list-item flex items-center justify-between p-tm-10 rounded-lg cursor-pointer"
                @click="toggleSubmenu(index)"
            >

              <!-- LEFT SIDE -->
              <div class="flex items-center gap-3">

          <span class="text-lg">
            {{ item.icon }}
          </span>

                <span v-show="!collapsed">
            {{ item.title }}
          </span>

              </div>

              <!-- ARROW -->
              <svg  v-if="item.children?.length && !collapsed" class="themora-dropdown-icon" :class="{ '-rotate-90': openedMenus.includes(index) }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z"></path></svg>

            </div>

            <!-- EXPANDED SUBMENU -->
            <ul
                v-if="item.children?.length && !collapsed"
                v-show="openedMenus.includes(index)"
                class="themora-submenu space-y-1 rounded-b-tm-6 bg-tm-dark-2"
                :class="{ 'open': openedMenus.includes(index) }"
            >

              <li class="cursor-pointer"
                  v-for="(child,childIndex) in item.children"
                  :key="childIndex"
              >
                {{ child.title }}
<!--                <a-->
<!--                    :href="child.link"-->
<!--                    class="block p-2 rounded-lg text-sm-->
<!--                   text-gray-600 dark:text-gray-300-->
<!--                   hover:bg-gray-100 dark:hover:bg-gray-700"-->
<!--                >-->
<!--                  {{ child.title }}-->
<!--                </a>-->
              </li>

            </ul>

            <!-- COLLAPSED FLYOUT SUBMENU -->
            <div
                v-if="collapsed && item.children?.length"
                v-show="hoveredMenu === index"
                class="absolute right-full top-0 mr-2
               bg-tm-dark
               border rounded-tm-12 w-52 z-50"
            >

              <ul class="themora-submenu open">
                <li
                    v-for="(child,childIndex) in item.children"
                    :key="childIndex"
                >
                  <a
                      :href="child.link"
                      class="block px-4 py-2 text-sm
                     hover:bg-gray-100 dark:hover:bg-gray-700"
                  >
                    {{ child.title }}
                  </a>
                </li>
              </ul>

            </div>

            <!-- TOOLTIP (for no children) -->
            <div
                v-if="collapsed && !item.children?.length"
                v-show="hoveredMenu === index"
                class="absolute right-full top-1/2 -translate-y-1/2 mr-2
               bg-black text-white text-xs px-2 py-1 rounded shadow"
            >
              {{ item.title }}
            </div>

          </li>

        </ul>
      </nav>
    </aside>

    <!-- CONTENT -->
    <section class="flex-1 flex flex-col overflow-hidden bg-white p-tm-30 rounded-tm-12">

      <header class="border-b border-dashed border-tm-light-grey py-4 flex justify-between">
        <button @click="openSidebar" class="lg:hidden">☰</button>
        <h2 class="text-2xl p-0">Welcome to Themora</h2>
        <button @click="toggleTheme" class="flex items-center justify-center size-tm-40 rounded bg-white border border-tm-light-grey">
          {{ isDark ? '☀️' : '🌙' }}
        </button>

      </header>

      <main class="py-6">
        <h2 class="text-xl font-bold text-white">تنظیمات عمومی</h2>
      </main>

      <footer class="pt-4 border-t border-dashed border-tm-light-grey">
        <button class="text-white bg-tm-green rounded-tm-6 px-6 py-2 cursor-pointer">save</button>
      </footer>
    </section>

  </div>
</template>