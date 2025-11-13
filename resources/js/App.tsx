import { Toaster } from "@/components/ui/toaster";
import { Toaster as Sonner } from "@/components/ui/sonner";
import { TooltipProvider } from "@/components/ui/tooltip";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Navbar from "./components/Navbar";
import Footer from "./components/Footer";
import Home from "./pages/Home";
import About from "./pages/About";
import Clubs from "./pages/Clubs";
import ClubDetail from "./pages/ClubDetail";
import Events from "./pages/Events";
import EventDetail from "./pages/EventDetail";
import Committees from "./pages/Committees";
import CommitteeDetail from "./pages/CommitteeDetail";
import Contact from "./pages/Contact";
import Gallery from "./pages/Gallery";
import NotFound from "./pages/NotFound";
import Login from "./pages/Login";
import Signup from "./pages/Signup";
import Admin from "./pages/Admin";

const queryClient = new QueryClient();

const App = () => (
    <QueryClientProvider client={queryClient}>
        <TooltipProvider>
            <Toaster />
            <Sonner />
            <BrowserRouter>
                <div className="flex flex-col min-h-screen">
                    <Navbar />
                    <main className="flex-1">
                        <Routes>
                            <Route path="/" element={<Home />} />
                            <Route path="/about" element={<About />} />
                            <Route path="/clubs" element={<Clubs />} />
                            <Route path="/clubs/:id" element={<ClubDetail />} />
                            <Route path="/events" element={<Events />} />
                            <Route
                                path="/events/:id"
                                element={<EventDetail />}
                            />
                            <Route
                                path="/committees"
                                element={<Committees />}
                            />
                            <Route
                                path="/committees/:id"
                                element={<CommitteeDetail />}
                            />
                            <Route path="/contact" element={<Contact />} />
                            <Route path="/gallery" element={<Gallery />} />
                            <Route path="/login" element={<Login />} />
                            <Route path="/signup" element={<Signup />} />
                            <Route path="/admin/*" element={<Admin />} />
                            {/* ADD ALL CUSTOM ROUTES ABOVE THE CATCH-ALL "*" ROUTE */}
                            <Route path="*" element={<NotFound />} />
                        </Routes>
                    </main>
                    <Footer />
                </div>
            </BrowserRouter>
        </TooltipProvider>
    </QueryClientProvider>
);

export default App;
