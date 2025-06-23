import Footer from '@/components/footer';
import Header from '@/components/header';

export default function AppHeaderFooterLayout(children: { children: Element[]; }) {
// export default function AppHeaderFooterLayout(children: React.ReactNode[]) {
    return (
        <>
            <Header />
                {children}
            <Footer />
        </>
    );
}
