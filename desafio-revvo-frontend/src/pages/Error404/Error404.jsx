import MainLayout from '../../layout/Container/MainLayout'
import './Error404.css'

export default function Error404() {
    return (
        <MainLayout>
            <div className='error__content'>
                <h1>Erro 404</h1>
                <h2>Página Não Encontrada</h2>
            </div>
        </MainLayout>
    )
}