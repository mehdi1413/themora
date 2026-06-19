declare const themoraData:{
    apiUrl:string
    nonce:string
}

const API_URL = themoraData.apiUrl

export async function getMedia(id:number){
    const response = await fetch(`${API_URL}media/${id}`)

    if(!response.ok){
        throw new Error(
            await response.text()
        )
    }

    const result = await response.json()

    return result.data
}