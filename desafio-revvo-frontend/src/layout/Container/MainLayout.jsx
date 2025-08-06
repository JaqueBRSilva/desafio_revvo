import Footer from '../../components/Footer'
import Header from '../../components/Header'
import './MainLayout.css'

export default function MainLayout({ children }) {
    return (
        <main className="main-layout">
            <Header />

            {children}

            <Footer />
        </main>
    )
}