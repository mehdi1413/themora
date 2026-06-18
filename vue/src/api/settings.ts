declare const themoraData:{
    apiUrl:string
    nonce:string
}

const API_URL = themoraData.apiUrl
export async function getSettings(){
    const response = await fetch(`${API_URL}settings`)
    const text = await response.text()

    if(!response.ok){
        throw new Error(text)
    }

    const result = JSON.parse(text)

    return result.data
}


export async function saveSettings(data:Record<string,any>){
    const response = await fetch(
        `${API_URL}settings`,
        {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-WP-Nonce': themoraData.nonce
            },
            body:JSON.stringify(data)
        }
    )

    if(!response.ok){
        const error = await response.text()
        throw new Error(error)
    }

    const result = await response.json()

    return result.data
}