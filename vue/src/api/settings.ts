declare const themoraData:{
    apiUrl:string
}

const API_URL = themoraData.apiUrl
console.log('API URL:', API_URL)
export async function getSettings2(){
    const response = await fetch(`${API_URL}/settings`)

    if(!response.ok){
        throw new Error('Failed to fetch settings')
    }

    const result = await response.json()

    return result.data
}


export async function getSettings(){
    const response = await fetch(`${API_URL}settings`)
    const text = await response.text()

    if(!response.ok){
        throw new Error(text)
    }

    const result = JSON.parse(text)

    return result.data
}

export async function saveSettings(
    data:Record<string,any>
){

    const response = await fetch(
        `${API_URL}/settings`,
        {
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify(data)
        }
    )


    if(!response.ok){
        throw new Error('Failed to save settings')
    }

    const result = await response.json()

    return result.data
}