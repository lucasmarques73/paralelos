<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="abastecer.aspx.cs" Inherits="exSlide01.abastecer" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <h1>Abastecer</h1>
        </div>
        <div>
            <asp:HyperLink ID="HyperLink3" runat="server" NavigateUrl="~/inicio.aspx">Inicio</asp:HyperLink>
            <br />
            <asp:HyperLink ID="HyperLink1" runat="server" NavigateUrl="~/abastecer.aspx">Abastecer</asp:HyperLink>
            <br />
            <asp:HyperLink ID="HyperLink2" runat="server" NavigateUrl="~/moedas.aspx">Moedas</asp:HyperLink>
        </div>
        <div>


            <asp:Label ID="Label1" runat="server" Text="Preço do Alcool:"></asp:Label>
            <asp:TextBox ID="tbAlcool" runat="server"></asp:TextBox>
            <br />
            <asp:Label ID="Label2" runat="server" Text="Preço da Gasolina:"></asp:Label>
            <asp:TextBox ID="tbGasolina" runat="server"></asp:TextBox>
            <br />
             <asp:Button ID="Button1" runat="server" Text="Calcular" OnClick="Button1_Click" />
            <br />
            <asp:Label ID="lbCalculado" runat="server" Text=""></asp:Label>
        </div>
       
    </form>
</body>
</html>
