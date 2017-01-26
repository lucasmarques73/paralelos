<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="abastecer.aspx.cs" Inherits="WebApplication1.abastecer" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Abastecimento</title>
</head>
<body>
    <form id="form1" runat="server">
    <div>

        <asp:HyperLink ID="HyperLink1" runat="server" ImageHeight="40px" NavigateUrl="~/inicio.aspx" ImageWidiht="40px" ImageUrl="~/Imagens/Home.png">Inicio</asp:HyperLink>
        &nbsp
        <asp:HyperLink ID="HyperLink2" runat="server" ImageHeight="40px" NavigateUrl="~/conversao.aspx" ImageWidiht="40px" ImageUrl="~/Imagens/moedas-ouro-dinheiro.png">Conversão</asp:HyperLink>
        
        <br />
        <br />

        <asp:Label ID="lbAlcool" runat="server" Text="Valor do litro do Alcool:"></asp:Label>
        &nbsp
        <asp:TextBox ID="tbValorAlcool" runat="server"></asp:TextBox>
        <br />
        <br />
        <asp:Label ID="LbGasolina" runat="server" Text="Valor do litro da Gasolina:"></asp:Label>
        &nbsp 
        <asp:TextBox ID="tbValorGasolina" runat="server"></asp:TextBox>

        <br />
        <br />

        <asp:Button ID="btCalcular" runat="server" Text="Calcular" OnClick="btCalcular_Click" />

        <br />
        <br />

        <asp:Label ID="lblConclusão" runat="server" Text="Abasteça com: "></asp:Label>

        

    </div>
    </form>
</body>
</html>
